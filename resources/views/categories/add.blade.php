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

        <form method ="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class = "row">
            <div class = "col-6 px-5">
                <h6> Category Information</h6>
                    <div class = "form-group">
                        <label>Item Name</label>
                        <input type = "text" name = "name" class="form-control" placeholder = "Input Name" required></input>
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
                    <div id="preview" ></div>
                    <br/>

                    <div class = "form-group" >
                        <label for="checkbox">Status</label><br/>
                        <input type="checkbox" id="status" name="status" value="Publish">&ensp; Publish<br/>
                    </div><br/>

                    <div style = "float: right;">
                    <input type = "button" value = "Cancel" class = "btn btn-light" onclick="window.location.href='{{ route('items.index') }}';">
                    <input type="submit" value = "Save" class = "btn btn-info" style = "color: white;">
                </div>
        
            </div>
            <div class = "col-6 px-5">  
                
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

