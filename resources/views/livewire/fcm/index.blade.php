<div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Система
        @endslot
        @slot('title')
            Уведомления
        @endslot
    @endcomponent


    <div class="row mb-2">
        <div class="col-md-6">
            <div class="mb-3">
                <button type="button" class="btn btn-primary waves-effect waves-light" wire:click="addItem()"><i
                        class="mdi mdi-plus me-2"></i> Добавить</button>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    @include('livewire.fcm.attempts')
    @include('livewire.fcm.create')
    @include('livewire.fcm.delete')

    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive mb-4">
                <table class="table table-centered table-striped datatable dt-responsive nowrap table-card-list"
                    style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Заголовок</th>
                            <th>Таргет</th>
                            <th>Топик</th>
                            <th>Дата обновления</th>
                            <th>Дата создания</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <span class="text-reset  fw-bold">{{ $item->title }}</span>
                                    @if ($item->is_birthday == 1)
                                        <span class="badge bg-primary">Поздравление <i class="bx bx-cake"></i></span>
                                    @endif
                                    @if ($item->news_id != null)
                                        <span class="badge bg-success">Новость <i class="uil uil-star"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->to_all == 1)
                                        Всем
                                    @else
                                        {{-- @switch($item->to_age)
                                            @case('x1825')
                                                18-25 лет
                                            @break
    
                                            @case('x2640')
                                                26-40 лет
                                            @break
    
                                            @case('x4160')
                                                41-60 лет
                                            @break
    
                                            @case('x60x')
                                                >60 лет
                                            @break
    
                                            @default
                                                *
                                        @endswitch
                                        / --}}
                                        @switch($item->to_gender)
                                            @case('male')
                                                <i class="bx bx-male" style="color: rgb(1, 24, 201)"></i>
                                            @break

                                            @case('female')
                                                <i class="bx bx-female" style="color: rgb(255, 0, 238)"></i>
                                            @break

                                            @default
                                                *
                                        @endswitch
                                        /

                                        @switch($item->to_platform)
                                            @case('android')
                                                <i class="uil uil-android" style="color: rgb(1, 201, 1)"></i>
                                            @break

                                            @case('ios')
                                                <i class="uil uil-apple" style="color: grey"></i>
                                            @break

                                            @default
                                                *
                                        @endswitch
                                    @endif
                                </td>
                                <td>{{ $item->topic }}</td>
                                <td>
                                    {{ $item->updated_at->format('d.m.Y H:i') }}
                                </td>
                                <td>
                                    {{ $item->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-sm"
                                        wire:click="editAttempts({{ $item->id }})">
                                        <i class="bx bx-send"></i> Отправить
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm"
                                        wire:click="editItem({{ $item->id }})">
                                        <i class="uil uil-edit-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        wire:click="openDeleteModal('{{ $item->id }}')">
                                        <i class="uil uil-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Нет данных</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style="height: 60vh">
                    <div class="card-body" style="overflow-y: auto;">
                        <div class="d-flex align-items-center">
                            <h6 class="text-primary fw-bold">
                                Очередь отправки
                            </h6>
                            <hr class="flex-grow-1 mx-2 text-primary">
                            <a href="#" wire:click.prevent="refreshAllAttempts">Обновить</a>
                        </div>
                        <div class="row">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table table-centered table-striped datatable dt-responsive nowrap table-card-list"
                                    style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Уведомление</th>
                                            <th>Статус</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_attempts as $a)
                                            <tr>
                                                <td>{{ $a->notification->title }}</td>
                                                <td>
                                                    @switch($a->status)
                                                        @case(0)
                                                            <i class="uil uil-clock-nine text-warning"></i> В очереди
                                                        @break

                                                        @case(1)
                                                            <i class="uil uil-check-circle text-success"></i> Отправлено
                                                        @break

                                                        @default
                                                            {{ $a->status }}
                                                    @endswitch
                                                </td>
                                                <td><button type="button" class="btn btn-outline-primary btn-sm"
                                                        wire:click="editAttempts({{ $a->notification_id }})">
                                                        <i class="uil uil-eye"></i>
                                                    </button></td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Очередь пуста</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('script')
            <script>
                window.addEventListener('open-attempts-modal', event => {
                    $('#addAttempt').modal('show');
                });
                window.addEventListener('close-attempts-modal', event => {
                    $('#addAttempt').modal('hide');
                });
                window.addEventListener('open-create-modal', event => {
                    $('#addItem').modal('show');
                });
                window.addEventListener('close-create-modal', event => {
                    $('#addItem').modal('hide');
                });
                window.addEventListener('open-delete-modal', event => {
                    $('#deleteConfirm').modal('show');
                });
                window.addEventListener('close-delete-modal', event => {
                    $('#deleteConfirm').modal('hide');
                });
            </script>
        @endsection
