<form wire:submit.prevent="createItem" class="custom-validation">
    <div class="modal fade" wire:ignore.self id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemLabel">
                        @if ($item_edit_id != '')
                            Изменить группу пользователей
                        @else
                            Создать группу пользователей
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
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="title">Заголовок</label>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="title" wire:model="title"
                                placeholder="Введите наименование">
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <label class="form-label" for="age_from">Возраст - от</label>
                                    @error('age_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="number" class="form-control" id="age_from" wire:model="age_from"
                                        placeholder="Введите значение">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="age_to">Возраст - до</label>
                                    @error('age_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="number" class="form-control" id="age_to" wire:model="age_to"
                                        placeholder="Введите значение">
                                </div>
                            </div>
                            <label class="form-label mt-3" for="barcode">Баркод</label>
                            @error('barcode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="barcode" wire:model="barcode"
                                placeholder="Введите значение">
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
