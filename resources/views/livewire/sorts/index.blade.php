<div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Контент
        @endslot
        @slot('title')
            Наши сорта
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

    @include('livewire.sorts.create')
    @include('livewire.sorts.delete')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <style>
        .driver-avatar {
            border-radius: 10px;
            box-shadow: 0 0 5px #dedede;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .driver-avatar-sm {
            border-radius: 10px;
            box-shadow: 0 0 5px #dedede;
            width: 50px;
            height: 50px;
            object-fit: contain;
        }
    </style>

    <style>
        .driver-avatar {
            border-radius: 10px;
            box-shadow: 0 0 5px #dedede;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .driver-avatar-sm {
            border-radius: 10px;
            box-shadow: 0 0 5px #dedede;
            width: 50px;
            height: 50px;
            object-fit: contain;
        }
    </style>
    <div class="row">
        @foreach ($items as $item)
            <div class="col-md-4 col-xl-2">
                <div class="card">
                    @if ($item->image)
                        <img src="{{ asset(str_replace('public/', 'storage/', $item->image)) }}" alt=""
                            class="card-img-top img-fluid">
                    @else
                        <img class="card-img-top img-fluid" src="{{ URL::asset('assets/images/small/img-1.jpg') }}"
                            alt="Card image cap">
                    @endif
                    <div class="card-body" style="padding-top: 10px!important;padding-bottom: 10px!important">
                        <div class="d-flex justify-content-end align-items-end">
                            <a wire:click="editItem({{ $item->id }})"
                                class="btn btn-outline-success waves-effect waves-light me-2"><i
                                    class="uil uil-edit-alt"></i> Редактировать</a>
                            <a wire:click="openDeleteModal({{ $item->id }})"
                                class="btn btn-outline-danger waves-effect waves-light"><i
                                    class="uil uil-trash-alt"></i></a>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div>
        @endforeach
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
