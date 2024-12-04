<div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Система
        @endslot
        @slot('title')
            Администраторы
        @endslot
    @endcomponent

    @include('livewire.admin.create')
    @include('livewire.admin.delete')
    
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="mb-3">
                <button type="button" class="btn btn-primary waves-effect waves-light" wire:click="addItem()">
                    <i class="mdi mdi-plus me-2"></i> Добавить
                </button>
            </div>
        </div>
    </div>


    <div class="table-responsive mb-4">
        <table class="table table-striped table-centered datatable dt-responsive nowrap table-card-list"
            style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Дата создания</th>
                    <th>Дата обновления</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $item->updated_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                wire:click="editItem('{{ $item->id }}')">
                                <i class="uil uil-pen"></i>
                            </button>
                            @if ($item->id != auth()->id())
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                wire:click="openDeleteModal('{{ $item->id }}')">
                                <i class="uil uil-trash-alt"></i>
                            </button>
                                
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
@section('script')
    <script>
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
