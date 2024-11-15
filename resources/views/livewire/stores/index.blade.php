<div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Контент
        @endslot
        @slot('title')
            Адреса и телефоны
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

    @include('livewire.stores.create')
    @include('livewire.stores.delete')

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
            <div class="col-md-4  col-xl-2 d-flex align-items-stretch">
                <div class="card" style="width: 100%">
                    @if ($item->image)
                        <img src="{{ asset(str_replace('public/', 'storage/', $item->image)) }}" alt=""
                            class="card-img-top img-fluid" style="height: 150px; object-fit: cover" height="100px">
                    @else
                        <img class="card-img-top img-fluid" src="{{ URL::asset('assets/images/small/img-1.jpg') }}"
                            alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $item->title }}</h4>
                        <h6 class="text-primary ">{{ $item->uptitle }}</h6>
                        <p class="card-title-desc mb-0">- {{ $item->phone }}</p>
                        <p class="card-title-desc mb-0">- {{ $item->hours }}</p>
                        <p class="card-title-desc mb-3">- {{ $item->weekend_plan }}</p>
                        <a wire:click= "editItem({{ $item->id }})"
                            class="btn btn-outline-primary waves-effect waves-light">Редактировать</a>
                        <a wire:click= "openDeleteModal({{ $item->id }})"
                            class="btn btn-outline-danger waves-effect waves-light">Удалить</a>
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
