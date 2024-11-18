<div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Система
        @endslot
        @slot('title')
            База пользователей приложения
        @endslot
    @endcomponent

    {{-- <div class="row mb-2">
        <div class="col-md-6">
            <div class="mb-3">
                <button type="button" class="btn btn-primary waves-effect waves-light" wire:click="addItem()"><i
                        class="mdi mdi-plus me-2"></i> Добавить</button>
            </div>
        </div>
    </div> --}}

    {{-- @include('livewire.news.create') --}}
    @include('livewire.users.delete')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <div class="row">

        <div class="table-responsive mb-4">
            <table class="table table-striped table-centered datatable dt-responsive nowrap table-card-list"
                style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr>
                        <th>Сессия</th>
                        <th>Устройство</th>
                        <th>Дата рождения</th>
                        <th>Пол</th>
                        <th>Дата обновления</th>
                        <th>Дата создания</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><span class="text-reset  fw-bold">{{ $item->session_id }}</span>
                                @if ($item->tester == 1)
                                    <span class="badge bg-success">Тестировщик</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->platform == 'android')
                                    <i class="uil uil-android" style="color: rgb(1, 201, 1)"></i>
                                @else
                                    @if ($item->platform == 'ios')
                                        <i class="uil uil-apple" style="color: grey"></i>
                                    @else
                                        -
                                    @endif

                                @endif
                    </td>
                    <td>{{ $item->birth }}</td>
                    <td>{{ $item->pol }}</td>
                    <td>
                        {{ $item->updated_at->format('d.m.Y H:i') }}
                    </td>
                    <td>
                        {{ $item->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            wire:click="openDeleteModal('{{ $item->session_id }}')">
                            <i class="uil uil-trash-alt"></i>
                        </button>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('script')
    <script>
        // window.addEventListener('open-create-modal', event => {
        //     $('#addItem').modal('show');
        // });
        // window.addEventListener('close-create-modal', event => {
        //     $('#addItem').modal('hide');
        // });
        window.addEventListener('open-delete-modal', event => {
            $('#deleteConfirm').modal('show');
        });
        window.addEventListener('close-delete-modal', event => {
            $('#deleteConfirm').modal('hide');
        });
    </script>
@endsection
