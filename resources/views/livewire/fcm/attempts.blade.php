<form wire:submit.prevent="createAttempt" class="custom-validation">
    <div class="modal fade" wire:ignore.self id="addAttempt" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="addAttemptLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAttemptLabel">
                        Отправить уведомление
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeAttemptsModal">
                    </button>
                </div>
                <div class="modal-body">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="row">
                        <div class="table-responsive mb-4">
                            <table
                                class="table table-centered table-striped datatable dt-responsive nowrap table-card-list"
                                style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Заголовок</th>
                                        <th>Содержание</th>
                                        <th>Таргет</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-reset  fw-bold">{{ $title }}</span>
                                            @if ($is_birthday)
                                                <span class="badge bg-primary">Поздравление</span>
                                            @endif
                                            @if ($news_id != null)
                                                <span class="badge bg-success">Новость <i
                                                        class="uil uil-star"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $body }}
                                        </td>
                                        <td>
                                            @if ($to_all == 'true')
                                                Всем
                                            @else
                                                {{-- @switch($to_age)
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
                                                @switch($to_gender)
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

                                                @switch($to_platform)
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


                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="vstack gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="formRadios" id="formRadios1"
                                        wire:model.live="send_now" value="true" @checked($send_now)>
                                    <label class="form-check-label" for="formRadios1">
                                        Отправить сейчас
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="formRadios" id="formRadios2"
                                        wire:model.live="send_now" value="false" @checked(!$send_now)>
                                    <label class="form-check-label" for="formRadios2">
                                        Указать время
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="send_testers"
                                    wire:model="send_testers">
                                <label class="form-check-label" for="send_testers">Тестовое уведомление <i
                                        class="uil uil-bug"></i>*</label>
                            </div>
                            <span class="text-muted">*Тестовое уведомление отправляется только тестировщикам попадающим
                                в таргет</span>
                            @if ($send_now === 'false')
                                <input class="form-control mt-3" type="datetime-local" wire:model="send_time"
                                    id="send_time" name="send_time">
                                @error('send_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            @if ($send_now === 'false')
                                Добавить в очередь <i class="bx bx-plus"></i>
                            @else
                                Отправить <i class="bx bx-send"></i>
                            @endif
                        </button>
                    </div>
                    @if (session()->has('message_attempt'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="uil uil-check me-2"></i>
                            {{ session('message_attempt') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                    <div class=" d-flex align-items-center mt-3 mb-3">
                        <span class="text-primary fw-bold" style="font-size: 12px;">
                            Очередь отправки
                        </span>
                        <hr class="flex-grow-1 mx-2 text-primary">
                        <a href="#" wire:click.prevent="refreshAttempts">Обновить</a>
                    </div>
                    <div class="row">
                        <div class="table-responsive mb-4">
                            <table
                                class="table table-centered table-striped datatable dt-responsive nowrap table-card-list"
                                style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>Создано</th> --}}
                                        <th>Запланированное время</th>
                                        <th>Статус</th>
                                        <th>Отправлено</th>
                                        <th>Вывод</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($attempts as $a)
                                        {{-- @for ($i = 0; $i < 50; $i++) --}}
                                        <tr>
                                            <td>{{ $a->id }}</td>
                                            {{-- <td>{{ $a->created_at->format('d.m.Y H:i') }} --}}
                                                @if ($a->testers == 1)
                                                    <span class="badge bg-primary">Тест <i class="uil uil-bug"></i>
                                                @endif
                                            </td>
                                            <td>{{ optional($a->planned)->format('d.m.Y H:i') }}</td>
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
                                            <td>{{ optional($a->sended)->format('d.m.Y H:i') }}</td>
                                            <td>{{ $a->output }}</td>
                                            <td><button type="button" class="btn btn-outline-danger btn-sm"
                                                    wire:click="deleteAttempt('{{ $a->id }}')">
                                                    <i class="uil uil-trash-alt"></i>
                                                </button></td>
                                        </tr>
                                        {{-- @endfor --}}
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                            wire:click="closeAttemptsModal()">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
