@extends('admin.layouts.app')
@section('title', 'View Driver - '.$user->full_name)
@section('content')
    <section class="content-header">
        <h1>Dashboard <small>Control panel</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('admin.clients')}}"><i class="fa fa-users"></i> Clients List</a></li>
            <li><a href="{{route('admin.clients.show', $user->id)}}"><i class="fa fa-users"></i> {{$user->full_name}}</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">

                                <div class="col-lg-6">
                                    <div id="galery-img">
                                        <a href="{{$user->avatar}}" title="Face">
                                            <img src="{{$user->avatar}}" class="user_avatar img-responsive img-circle">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="id_class big_id float-left">{{$user->id}}</div>
                                    <div class="clearfix"></div>
                                    <h2>
                                        {{$user->full_name}}
                                        @if($user->online)
                                            <div class="online_status big online"></div>
                                        @else
                                            <div class="online_status big offline"></div>
                                        @endif
                                    </h2>

                                    @if($user->rate['cnt']>0)
                                        <div class="col-xs-12">
                                            <div class="rate user_rating">
                                                <?php $width = (100 / 5) * $user->rate['avg'];?>
                                                <div class="rating_stars_full">
                                                    <div class="fill_stars" style="width: {{$width}}%">&nbsp;</div>
                                                </div>
                                                <div class="rate_text">Rate : {{$user->rate['avg']}} / 5 From {{$user->rate['cnt']}} reviews</div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">License plate number :</div>
                                        <div class="col-xs-12 col-md-6">{{$user->license}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">E-mail :</div>
                                        <div class="col-xs-12 col-md-6">{{$user->email}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">Phone Number :</div>
                                        <div class="col-xs-12 col-md-6">{{$user->phone}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">Date registrations : </div>
                                        <div class="col-xs-12 col-md-6">{{$user->created_at}}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 text-right">
                                        <a href="{{route('admin.clients.edit', $user->id)}}" class="btn btn-success">Edit</a>
                                    </div>

                                    <div class="col-xs-12 col-md-12">
                                        <h2>Info : </h2>
                                        <div>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                                            Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($favorites)>0)
                        <div class="row">
                            <div class="col-xs-12 col-md-12 favorites_block">
                                <h2>Favourites :</h2>
                                <?php $i = 0; ?>
                                @foreach($favorites as $favorite)
                                    <?php $n = $i + 1; ?>
                                    <div class="col-xs-12 col-md-3 fav_{{$i}}" rel="{{$i}}">
                                        <div class="number">{{$n}}</div>
                                        <input type="hidden" name="fav_0">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <label for="name_{{$i}}">Name :</label>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                {{$favorite->name}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <label for="lat_{{$i}}">Latitude :</label>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                {{$favorite->lat}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <label for="lng_{{$i}}">Longitude :</label>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                {{$favorite->lng}}
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++ ?>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(count($orders)>0)
                        <div class="row">
                            <h2>History orders :</h2>
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Starting Point</th>
                                    <th>Drop-off Point</th>
                                    <th>Date Time</th>
                                    <th>Driver</th>
                                    <th>Destination</th>
                                    <th>Price</th>
                                    <th>Map</th>
                                </tr>
                            @foreach($orders as $key => $order)
                                    <tr class="order_{{$key}}">
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->from_name}}</td>
                                        <td>{{$order->to_name}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->driver_full_name}}</td>
                                        <td>{{$order->len}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>
                                            @if($order->map_enabled==true)
                                            <a href="https://www.google.com.ua/maps/dir/{{$order->from->lat}},{{$order->from->lng}}/{{$order->to->lat}},{{$order->to->lng}}/@<?php echo $order->from->lat.",".$order->from->lng ?>,{{$order->zoom}}z?hl=en" target="_blank">
                                                <i class="fa fa-map-marker show_map_marker" from="{{$order->from->lat}},{{$order->from->lng}}" to="{{$order->to->lat}},{{$order->to->lng}}">
                                                </i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>

                            @endforeach
                            </table>
                            <div class="pagination">
                                {{$orders->links()}}
                            </div>
                        </div>
                        @endif

                        @if(count($rates)>0)
                            <div class="row">
                                <h2>Comments</h2>
                                @foreach($rates as $rate)
                                    <div class="col-xs-12 col-md-3">
                                        <div class="col-xs-12">
                                            @if(!$rate->deleted_user)
                                            <a href="{{route('admin.drivers.show', $rate->from)}}">
                                                {{$rate->full_name}}
                                            </a>
                                            @else
                                                {{$rate->full_name}}
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <img src="{{$rate->avatar}}" class="user_avatar">
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                            {{$rate->text}}
                                            <div class="clearfix"></div>
                                            <div class="rate user_rating">
                                                <?php $width = (100 / 5) * $rate->rate;?>
                                                <div class="rating_stars_full">
                                                    <div class="fill_stars"  style="width: {{$width}}%">&nbsp;</div>
                                                </div>
                                                <div class="rate_text">{{$rate->rate}} / 5 </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Driver confirm</h4>
                </div>
                <div class="modal-body">
                    <p>A confirmation email has been sent to the driver</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
