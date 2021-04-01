@extends('layouts.masterAdmin')
@section('title', 'Admin - Orders')
@section('content')
    <section class="orders container">
        <h3 class="h3 mt-3">All orders</h3>
        <div class="row">
            <form action="#filter" method="get" class="mb-5 col-md-10" id="#filter">
                <input type="hidden" name="page" value="{{ $filter['page'] }}">
                <div class="row">
                    <div class="col-md-2">
                        <select class="form-control" onchange="this.form.submit()" name="perPage">
                            <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="10">10 per Page</option>
                            <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="20">20 per Page</option>
                            <option @if (!empty($filter['perPage']) && $filter['perPage'] === '30') selected @endif value="30">30 per Page</option>
                            <option @if (!empty($filter['perPage']) && $filter['perPage'] === '40') selected @endif value="40">40 per Page</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" onchange="this.form.submit()" name="filter">
                            <option value="">Sort By</option>
                            <option @if (!empty($filter['filter']) && $filter['filter'] === 'older') selected @endif value="older">From older to newer</option>
                            <option @if (!empty($filter['filter']) && $filter['filter'] === 'newer') selected @endif value="newer">From newer to older</option>
                            <option @if (!empty($filter['filter']) && $filter['filter'] === 'low') selected @endif value="low">Low value</option>
                            <option @if (!empty($filter['filter']) && $filter['filter'] === 'high') selected @endif value="high">High value</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" onchange="this.form.submit()" name="status">
                            <option value="">Status</option>
                            <option @if (!empty($filter['status']) && $filter['status'] === '1') selected @endif value="1">Open</option>
                            <option @if (!empty($filter['status']) && $filter['status'] === '2') selected @endif value="2">Finished</option>
                            <option @if (!empty($filter['status']) && $filter['status'] === '3') selected @endif value="3">Canceled</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="col-md-8">
                @if (!empty($orders))
                    @foreach ($orders as $order)
                        @php
                            $status = 'Open';
                            $class = 'text-warning';
                            if ($order->status === '1') {
                                $status = 'Finished';
                                $class = 'text-success';
                            } elseif ($order->status === '2') {
                                $status = 'Canceled';
                                $class = 'text-danger';
                            }
                            $date = strtotime($order->dt_order);
                        @endphp
                        <div class="order__itens">
                            <input type="checkbox" class="mass__deletion--order" name="order[]" value="{{ $order->id }}">
                            <a href="{{ route('showOrderAdmin', $order->id) }}" class="order__item">
                                <span class="order__number--item">{{ $order->n_order }}</span>
                                <span class="order__total--price">{{ $order->total_price }}</span>
                                <span class="order__status--item {{ $class }}">{{ $status }}</span>
                                <span class="order__date">{{ date('d/m/Y', $date) }}</span>
                            </a>
                        </div>
                    @endforeach
                    @php
                        $next = $filter['page'] <= 1 ? 2 : $filter['page'] + 1;
                        $previous = $filter['page'] <= 1 ? 1 : $filter['page'] - 1;
                        
                        $nextPage = '?page=' . $next;
                        $previousPage = '?page=' . $previous;
                        
                        if (!empty($filter['perPage'])) {
                            $nextPage .= '&perPage=' . $filter['perPage'];
                            $previousPage .= '&perPage=' . $filter['perPage'];
                            $filter['perPage'] = (int) $filter['perPage'];
                        }
                        
                        if (!empty($filter['filter'])) {
                            $nextPage .= '&filter=' . $filter['filter'];
                            $previousPage .= '&filter=' . $filter['filter'];
                        }
                        
                        if (!empty($filter['status'])) {
                            $nextPage .= '&status=' . $filter['status'];
                            $previousPage .= '&status=' . $filter['status'];
                        }
                        
                        $nextPage .= '#filter';
                        $previousPage .= '#filter';
                        $filter['page'] = (int) $filter['page'];
                        $last = $orders->lastPage();
                    @endphp
                    <div class="pagination">
                        @if ($last === $filter['page'] && $filter['page'] > 1)
                            <a class="pagination__link" href="{{ url(route('ordersAdmin') . $previousPage) }}">Prev</a>
                            <span class="pagination__link">Next</span>
                        @elseif($last > $filter['page'] && $filter['page'] > 1)
                            <a class="pagination__link" href="{{ url(route('ordersAdmin') . $previousPage) }}">Prev</a>
                            <a class="pagination__link" href="{{ url(route('ordersAdmin') . $nextPage) }}">Next</a>
                        @elseif($filter['page'] === 1 && $last > 1)
                            <span class="pagination__link">Prev</span>
                            <a class="pagination__link" href="{{ url(route('ordersAdmin') . $nextPage) }}">Next</a>
                        @endif
                    </div>
                @else
                    <p class="h4">There are no orders. <a href="{{ route('adminHome') }}">Click here</a> to register.</p>
                @endif
            </div>
            @if (!empty($orders))
            <div class="col-md-4">
                <button class="delete__all btn btn-danger">Delete selected orders</button>
            </div>
            @endif
        </div>
    </section>
    @csrf
@endsection
@section('page', url('js/pages/indexOrder.js'))
