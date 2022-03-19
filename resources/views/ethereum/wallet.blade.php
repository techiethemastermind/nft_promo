@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">
    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Ethereum</h2>

                    <ol class="breadcrumb p-0 m-0">

                        <li class="breadcrumb-item active">
                            Ethereum
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="javascript:void(0)" id="btn_update" class="btn btn-outline-secondary">Manual Update Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Ethereum Wallets</div>
            </div>
            <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                <div class="table" data-toggle="lists" data-lists-sort-by="js-lists-values-schedule" data-lists-sort-desc="true" data-lists-values="[&quot;js-lists-values-no&quot;]">
                    <table class="table mb-0 thead-border-top-0 table-nowrap" data-page-length="5">
                        <thead>
                            <tr>
                                <th style="width: 18px;" class="pr-0"></th>
                                <th> Rank </th>
                                <th> Address </th>
                                <th> Balance </th>
                                <th> Percent (%) </th>
                                <th> Tx Count </th>
                                <th> Name Tag </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($wallets as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)">
                                            <strong>{{ $item->address }}</strong>
                                        </a>
                                    </td>
                                    <td>{{ $item->balance }}</td>
                                    <td>{{ $item->percent }}</td>
                                    <td>{{ $item->txCount }}</td>
                                    <td>{{ $item->tagName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer p-8pt">
                    @if($wallets->hasPages())
                    {{ $wallets->links('layouts.parts.page') }}
                    @else
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Page 1">
                                <span>1</span>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Next">
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')

<script>

    $(function() {

        $('#btn_update').on('click', (e) => {

            $.ajax({
                method: "POST",
                url: "{{ route('ethereum.update') }}",
                success: function(res) {
                    console.log(res)
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });
</script>
@endpush
