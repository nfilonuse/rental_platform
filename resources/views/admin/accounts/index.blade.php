@extends('layouts.admin')
@section('title', 'Package List')
@section('content')
		<script>
		/*
			$(function(){
				$(".amc_table").dataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/locations/"				
				});
			})
		*/
		</script>
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.accounts.create')}}">Create account</a>
        </div>
        <div class="ap-table">
        	<table id="example" class="display responsive nowrap amc_table" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">Account name</th>
                        <th class="min-tablet-l">Account password</th>
                    	<th class="all">IATA Num</th>
                        <th class="all">Res source</th>
                        <th class="all">Company</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                	<tr>
                    	<td>{{$account->account_number}}</td>
                        <td>{{$account->account_password}}</td>
                        <td>{{$account->iata_number}}</td>
                        <td>{{$account->account_res_source}}</td>
                        <td>{{$account->company->name}}</td>
                        <td><a href="{{route('admin.accounts.edit', $account->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.accounts.delete', $account->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
