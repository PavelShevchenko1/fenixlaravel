<?php

namespace App\Livewire;

use App\Models\FxFcmNotification;
use App\Models\FxFcmNotificationAttempt;
use App\Models\FxNews;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class NotificationComponent extends Component
{



    use WithFileUploads;

    //Form Fields

    public $title,
        $body,
        $news_id = null,
        $to_all = 'false',
        $to_age,
        $to_gender,
        $to_platform,
        $is_birthday = false,
        $image_select,
        $image;

    // Atempts
    public $attempts = array(),
        $send_now = 'true',
        $send_testers = false,
        $send_time = null;

    public $all_attempts = array();
    //Helpers
    public $item_edit_id,
        $item_delete_id,
        $item_delete_name;


    public function addItem()
    {
        $this->resetInputFields();
        $this->openCreateModal();
    }

    public function editItem($edit_id)
    {
        $this->resetInputFields();
        $editItem = FxFcmNotification::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->title = $editItem->title;
        $this->body = $editItem->body;
        $this->news_id = $editItem->news_id;
        $this->to_all = $editItem->to_all == 1 ? 'true' : 'false';
        $this->to_age = $editItem->to_age;
        $this->to_gender = $editItem->to_gender;
        $this->to_platform = $editItem->to_platform;
        $this->is_birthday = $editItem->is_birthday == 1 ? true : false;
        $this->image = $editItem->image ? str_replace('public/', 'storage/', $editItem->image) : null;
        $now = now();
        $this->send_time = $now->minute < 50 ? $now->copy()->minute(0)->addHour() : $now->copy()->minute(0)->addHours(2);
        $this->openCreateModal();
    }

    public function editAttempts($edit_id)
    {
        $this->resetInputFields();
        $editItem = FxFcmNotification::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->attempts = FxFcmNotificationAttempt::where('notification_id', $this->item_edit_id)->orderBy('updated_at', 'desc')->get();
        $this->title = $editItem->title;
        $this->body = $editItem->body;
        $this->news_id = $editItem->news_id;
        $this->to_all = $editItem->to_all == 1 ? 'true' : 'false';
        $this->to_age = $editItem->to_age;
        $this->to_gender = $editItem->to_gender;
        $this->to_platform = $editItem->to_platform;
        $this->is_birthday = $editItem->is_birthday == 1 ? true : false;
        $this->image = $editItem->image ? str_replace('public/', 'storage/', $editItem->image) : null;
        $this->openAttemptsModal();
    }


    public function createItem()
    {
        $this->validate([
            'title' => 'required|string|min:5|max:255',
            'body' => 'required|string|min:15|max:255',
            'news_id' => 'nullable|sometimes|integer|exists:fx_news,id',
            'to_all' => 'nullable|sometimes|in:true,false',
            'to_age' => 'nullable|sometimes|string',
            'to_gender' => 'nullable|sometimes|string',
            'to_platform' => 'nullable|sometimes|string',
            'is_birthday' => 'nullable|sometimes|boolean',
            'image_select' => 'nullable|sometimes|image|max:3072'
        ]);

        $isEditing = $this->item_edit_id != '';
        $item = $isEditing ? FxFcmNotification::find($this->item_edit_id) : new FxFcmNotification;
        $item->title = $this->title;
        $item->body = $this->body;
        $item->news_id = $this->news_id == null || $this->news_id == '' ? null : $this->news_id;
        $item->to_all = $this->to_all == 'true' ? true : false;
        $item->to_age = $this->to_age;
        $item->to_gender = $this->to_gender;
        $item->to_platform = $this->to_platform;
        $item->is_birthday = $this->is_birthday  == true ? true : false;
        if ($this->image_select) {
            $old_image = $item->image;
            $item->image = $this->image_select->store('public/uploads/fcm');
            if ($old_image != null) {
                Storage::delete($old_image);
            }
        }

        $item->save();


        if ($isEditing) {
            session()->flash('message', 'Информация об уведомлении "' . $this->title . '" обновлена!');
        } else {
            session()->flash('message', 'Добавлено уведомление "' . $this->title . '"!');
        }

        $this->resetInputFields();

        $this->dispatch('close-create-modal');
    }


    public function createAttempt()
    {
        $this->validate([
            'send_now' => 'nullable|sometimes|in:true,false',
            'send_time' => 'required_if:send_now,false|nullable|date',
            'send_testers' => 'nullable|sometimes|boolean',
        ]);

        $attempt = new FxFcmNotificationAttempt;
        $attempt->notification_id = $this->item_edit_id;
        $attempt->planned = $this->send_time;
        $attempt->testers = $this->send_testers  == true ? true : false;
        $attempt->save();

        if (!$this->send_time) {
            $attempt->planned = $attempt->created_at;
            $attempt->save();
        }

        $this->attempts = FxFcmNotificationAttempt::where('notification_id', $this->item_edit_id)->orderBy('updated_at', 'desc')->get();


        session()->flash('message_attempt', 'Уведомление добавлено в очередь!');

        // $this->closeAttemptsModal();
    }

    public function refreshAttempts()
    {
        $this->attempts = FxFcmNotificationAttempt::where('notification_id', $this->item_edit_id)->orderBy('updated_at', 'desc')->get();
    }
    public function refreshAllAttempts()
    {
        $this->all_attempts = FxFcmNotificationAttempt::orderBy('updated_at', 'desc')->get();
    }

    public function deleteAttempt($attempt_id)
    {
        FxFcmNotificationAttempt::find($attempt_id)->delete();
        $this->attempts = FxFcmNotificationAttempt::where('notification_id', $this->item_edit_id)->orderBy('updated_at', 'desc')->get();
        session()->flash('message_attempt', 'Очередь удалена!');
    }


    public function deleteItem()
    {
        if ($this->item_delete_id == null) {
            return;
        }
        $itemToDelete = FxFcmNotification::find($this->item_delete_id);
        $itemToDelete->delete();
        $this->resetInputFields();
        $this->closeDeleteModal();
        session()->flash('message', 'Уведомление удалено!');
    }

    public function openDeleteModal($i)
    {
        $itemToDelete = FxFcmNotification::find($i);
        $this->item_delete_id = $itemToDelete->id;
        $this->item_delete_name = $itemToDelete->title;
        $this->dispatch('open-delete-modal');
    }

    public function closeDeleteModal()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->dispatch('close-delete-modal');
    }
    public function openCreateModal()
    {
        $this->dispatch('open-create-modal');
    }

    public function openAttemptsModal()
    {
        $this->dispatch('open-attempts-modal');
    }

    public function closeAttemptsModal()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->send_time = null;
        $this->send_testers = false;
        $this->attempts  = array();
        $this->dispatch('close-attempts-modal');
    }

    public function closeCreateModal()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->dispatch('close-create-modal');
    }

    private function resetInputFields()
    {

        $this->item_edit_id = '';
        $this->item_delete_id = '';
        $this->item_delete_name = '';

        $this->title = '';
        $this->body = '';
        $this->news_id = null;
        $this->to_all = 'false';
        $this->to_age = null;
        $this->to_gender = null;
        $this->to_platform = null;
        $this->is_birthday = false;
        $this->image_select = null;
        $this->image = null;
    }


    public function render()
    {
        $items = FxFcmNotification::orderBy('updated_at', 'desc')->get();
        $all_news = FxNews::orderBy('updated_at', 'desc')->get();
        $this->all_attempts = FxFcmNotificationAttempt::orderBy('updated_at', 'desc')->get();
        return view('livewire.fcm.index', compact('items', 'all_news'))
            ->extends('layouts.master')
            ->section('content');
    }

    public function setNewsContent()
    {
        if ($this->news_id == null || $this->news_id == '') {
            return;
        }

        $selected_news = FxNews::find($this->news_id);
        $this->title = $selected_news->title;
        $this->body = $selected_news->short_description;
    }
}
