<form wire:submit.prevent="createItem" class="custom-validation">
    <div class="modal fade" wire:ignore.self id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemLabel">
                        @if ($item_edit_id != '')
                            Изменить сорт
                        @else
                            Создать сорт
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeCreateModal">
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <div>
                                {{-- <div wire:ignore> --}}
                                <textarea class="form-control" rows="5" id="descr" wire:model="descr"></textarea>
                            </div>
                            @error('descr')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label" for="image">Изображение</label>
                                @if ($image_select)
                                    <img src="{{ $image_select->temporaryUrl() }}" alt=""
                                        class="driver-avatar mb-3">
                                @else
                                    @if ($image)
                                        <img src="{{ asset($image) }}" alt="" style="border-radius: 20px"
                                            class="driver-avatar mb-3">
                                    @endif
                                @endif

                            </div>
                            <input type="file" class="form-control" name="image_select" id="image_select"
                                wire:model="image_select" accept="image/png, image/jpeg, image/webp">
                            @error('image_select')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                        wire:click="closeCreateModal()">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</form>
