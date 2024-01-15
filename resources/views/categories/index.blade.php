@extends('layouts.app')

@section('content')
<div class="row mx-5">
    <div class = "col-2">
        <h3>Admin Panel </h3>
        <br/>
        <div id = "label" class = "rounded p-1" onclick="window.location.href='{{ route('items.index') }}';">
            <i class="bi bi-grid"></i>
            <a href = "{{ route('items.index') }}" src = "" > Item </a>
        </div><br/>
        <div id = "label" class = "rounded p-1" onclick="window.location.href='{{ route('categories.index') }}';">
            <i class="bi bi-list-task"></i>
            <a href = "{{ route('categories.index') }}" src = "" > Category </a>
        </div><br/>

        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <p style = "color: black"> <i class="bi bi-box-arrow-right"></i> Logout </p>
        </a>
    </div>

    <div class = "col-10">
        <p > Categories List </p>
        
        <span class = "btn btn-info" style = "color: white; float:right;"
        onclick = "window.location.href ='{{ route('categories.add')  }}'"> + Add Categories </span>
        <br/>
        <div class = "mx-auto">
        <table class="table mx-auto ">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>No:</th>
                    <th>Category </th>
                    <th>Publish</th>

                </tr>
            </thead>
            <tbody>
           
           
            @php
                $counter = 1;
            @endphp
            @foreach ($categories as $i)
            <tr>
                <td> 
                    <span onclick="updateStatusWithPage('{{ route('categories.edit', ['id' => $i['id']]) }}) }}');"> 
                        <i class="bi bi-pencil rounded p-1"></i>
                    </span> 
                    <span  onclick="updateStatusWithPage('{{ route('categories.destroy', ['id' => $i['id']]) }}) }}');">
                        <i class="bi bi-bucket rounded p-1"></i>
                    </span>
                 
                </td>
                <td>{{  $counter}} </td>
                <td>{{  $i['name'] }} </td>
                <td> 
                @php
                    $newStatus = ($i['status'] == "Publish") ? "Not Published" : "Publish";
                @endphp
                @if($i['status'] == "Publish")
                    <div class="form-check form-switch custom-switch" >
                        <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckDefault" 
                        checked
                        onclick="updateStatusWithPage('{{ route('categories.status', ['id' => $i['id'], 'status' => $newStatus]) }}');">

                    </div>
                @else
                    <div class="form-check form-switch">
                        <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckDefault" 
                        onclick="updateStatusWithPage('{{ route('categories.status', ['id' => $i['id'], 'status' => $newStatus ]) }}');">
                    </div>
                @endif
                    <!-- Hidden input field to store the value -->
                    <input type="hidden" name="status" id="status" value="{{  $i['status'] }}">
                </td>
            </tr>
            @php
                $counter++;
            @endphp
            @endforeach
            </tbody>
        </table>
        @php
            $start = ($categories->currentPage() - 1) * $categories->perPage() + 1;
            $end = $start + $categories->count() - 1;
        @endphp
        <span>Showing {{ $start }} to {{ $end }} of {{ $categories->total() }} entries</span>
        <div class="pagination-container">
            {{ $categories->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>
</div>
<script>
    function updateStatusWithPage(url) {
        // Get the current page number
        var currentPage = {{ $categories->currentPage() }};
        
        // Append the current page to the URL
        var urlWithPage = url + '?page=' + currentPage;

        // Redirect to the updated URL
        window.location.href = urlWithPage;
    }
</script>
@endsection
