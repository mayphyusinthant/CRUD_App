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
    </div>

    <div class = "col-10">
        <p > Items List > Add Items</p>
        <div  class = "rounded p-1  px-3 py-2 title"> 
                Add Items
        </div>
        <br/>

        <form method="POST" action="{{ route('items.update', ['id' => $item->id]) }}">
        @csrf
        <div class = "row">
            <div class = "col-6 px-5">
                <h6> Item Information</h6>
                    <div class = "form-group">
                        <label>Item Name</label>
                        <input type = "text" name = "name" class="form-control" placeholder = '{{ $item->name}}' required></input>
                    </div><br/>
            
                    <div class = "form-group" required>
                    <label>Select Category</label>
                        <select class = "form-control" name = "category_id">
                            @foreach($categories as $category)
                                <option value = "{{ $category['id'] }}">
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div><br/>

                    <div class = "form-group">
                        <label>Price</label>
                        <input type = "text" name = "price" class="form-control" placeholder = '{{ $item->price }}' required></input>
                    </div><br/>

                    <div class = "form-group">
                        <label>Description</label>
                        <textarea type = "text" name = "description" class="form-control" 
                            rows = "4" cols = "6" required> {{ $item->description }}</textarea>
                    </div><br/>
            
                    <div class = "form-group" required>
                    <label>Select Item Condition</label>
                        <select class = "form-control" name = "condition">
                            <option value="{{ $item->condition}}" disabled selected>
                                {{ $item->condition}}
                            </option>
                            <option value = "New"> New </option>
                            <option value = "Used"> Used  </option>
                            <option value = "Good Second Hand"> Good Second Hand  </option>

                        </select>
                    </div><br/>

                    <div class = "form-group" required>
                    <label>Select Item Type</label>
                        <select class = "form-control" name = "type" >
                            <option value="{{ $item->type }}" disabled selected>{{ $item->type }}</option>
                            <option value = "For Buy"> For Buy </option>
                            <option value = "For Sell"> For Sell  </option>
                            <option value = "For Exchange"> For Exchange  </option>

                        </select>
                    </div><br/>

                    <div class = "form-group" >
                        <label for="checkbox">Status</label><br/>
                        <input type="checkbox" id="status" name="status" value="Publish">&ensp; Publish<br/>
                    </div><br/>

                    <div class = "form-group" >
                        <label>Item Photo</label>
                        <p class = "text-muted" style = "font-size: 12px;" > Recommended Size 400 * 200 </p>
                        <div id="drop-area" >
                            <label class = "text-muted">
                                <i class="bi bi-cloud-upload"></i> <br/>
                                Drag and Drop Here <br/> or </label> <br/>
                            <span class = "btn btn-info" style = "color: white;"> Choose File </span>
                            <input type="file" id="fileInput" accept="image/*" style="display: none;">
                        </div>
                    </div>
                    <div id="preview"></div>
        
            </div>
            <div class = "col-6 px-5">  
                <h6> Owner Information</h6>

                <div class = "form-group">
                        <label>Owner Name</label>
                        <input type = "text" name = "owner" class="form-control" placeholder = "{{ $item->owner->name }}" required></input>
                </div><br/>

                <div class = "form-group">
                    <label>Contact Number</label>
                    <input type = "text" name = "number" class="form-control" placeholder = "{{ $item->owner->contact_num }}" required></input>
                </div><br/>

                <div class = "form-group">
                    <label>Address</label>
                    <textarea type = "text" name = "address" class="form-control" 
                            rows = "4" cols = "6" required> {{ $item->owner->address }} </textarea>
                </div><br/>

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488797.97858870623!2d95.85190381947201!3d16.83953684242046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1705325651090!5m2!1sen!2smm" width="650" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <br/>
                <div style = "float: right;">
                    <input type = "button" value = "Cancel" class = "btn btn-light" onclick="window.location.href='{{ route('items.index') }}';">
                    <input type="submit" value = "Save" class = "btn btn-info" style = "color: white;">
                </div>
            </div>
        </div>
        </form>

        <div class = "mx-auto">
        
    </div>
    </div>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');

    // Prevent default behavior when a file is dragged over the drop area
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('highlight');
    });

    // Remove highlighting when the file is dragged out of the drop area
    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('highlight');
    });

    // Handle the dropped file
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('highlight');

        const files = e.dataTransfer.files;

        if (files.length > 0) {
            handleFiles(files);
        }
    });

    // Open file input when the drop area is clicked
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle files when selected via file input
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;

        if (files.length > 0) {
            handleFiles(files);
        }
    });

    // Function to handle the selected files
    function handleFiles(files) {
        const file = files[0];

        // Display the image preview
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = (e) => {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };

            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    }

    

</script>

@endsection

