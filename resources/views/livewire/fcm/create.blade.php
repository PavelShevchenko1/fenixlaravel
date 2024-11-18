<form wire:submit.prevent="createItem" class="custom-validation">
    <div class="modal fade" wire:ignore.self id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemLabel">
                        @if ($item_edit_id != '')
                            Изменить уведомление
                        @else
                            Создать уведомление
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
                            <label class="form-label" for="title">Заголовок</label>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="title" wire:model="title"
                                placeholder="Введите заголовок">
                            {{--  --}}
                            <label class="form-label mt-3" for="body">Содержание</label>
                            @error('body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="body" wire:model="body"
                                placeholder="Введите содержание">

                            <label class="form-label mt-3" for="news_id">Привязка к новости</label>
                            <select class="form-select" id="news_id" wire:model.live="news_id">
                                <option value="">Не указано</option>
                                @foreach ($all_news as $news)
                                    <option value="{{ $news->id }}">{{ $news->title }}</option>
                                @endforeach
                            </select>
                            @error('to_gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if ($news_id != null && $news_id != '')
                                <a href="#" wire:click.prevent="setNewsContent">Заполнить форму по новости</a>
                            @endif

                            <div class="form-check form-switch mt-3">
                                <input type="checkbox" class="form-check-input" id="is_birthday"
                                    wire:model="is_birthday">
                                <label class="form-check-label" for="is_birthday">Поздравление <i
                                        class="bx bx-cake text-primary"></i></label>
                            </div>
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
                    <hr>
                    <div>
                        <h5 class="font-size-14 mb-3">
                            <i class="mdi mdi-arrow-right text-primary me-1"></i>Таргет
                        </h5>
                        <div class="vstack gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="formRadios" id="formRadios1"
                                    wire:model.live="to_all" value="true" @checked($to_all)>
                                <label class="form-check-label" for="formRadios1">
                                    Всем пользователям
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="formRadios" id="formRadios2"
                                    wire:model.live="to_all" value="false" @checked(!$to_all)>
                                <label class="form-check-label" for="formRadios2">
                                    Указать группу
                                </label>
                            </div>
                        </div>
                    </div>
                    @if ($to_all === 'false')
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="to_gender">Пол</label>
                                    <select class="form-select" id="to_gender" wire:model="to_gender">
                                        <option value="">Всем</option>
                                        <option value="male" @checked(true)>Мужчины</option>
                                        <option value="female">Женщины</option>
                                    </select>
                                    @error('to_gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="to_age">Возраст</label>
                                    <select class="form-select" id="to_age" wire:model="to_age">
                                        <option value="">Всем</option>
                                        <option value="x1825">18-25 лет</option>
                                        <option value="x2640">26-40 лет</option>
                                        <option value="x4160">41-60 лет</option>
                                        <option value="x60x">>60 лет</option>
                                    </select>
                                    @error('to_age')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="to_platform">Платформа</label>
                                    <select class="form-select" id="to_platform" wire:model="to_platform">
                                        <option value="">Всем</option>
                                        <option value="ios">iOS</option>
                                        <option value="android">Android</option>
                                    </select>
                                    @error('to_platform')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                    @endif
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
