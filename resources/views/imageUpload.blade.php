<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Ajax Image Upload Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
         
<body>
<div class="container">
           
    <div class="panel panel-primary">
      
      <div class="panel-heading">
        <h2>Laravel 10 Ajax Image Upload Example - ItSolutionStuff.com</h2>
      </div>
     
      <div class="panel-body">
          
        <img id="preview-image" width="300px">
        
        <form action="{{ route('image.store') }}" method="POST" id="image-upload" enctype="multipart/form-data">
            @csrf
 
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
     
            <div class="mb-3">
                <label class="form-label" for="inputImage">Image:</label>
                <input 
                    type="file" 
                    name="image" 
                    id="inputImage"
                    class="form-control">
                <span class="text-danger" id="image-input-error"></span>
            </div>
      
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
         
        </form>
         
      </div>
    </div>
</div>
</body>
    
<script type="text/javascript">
      
    /*------------------------------------------
    --------------------------------------------
    File Input Change Event
    --------------------------------------------
    --------------------------------------------*/
    $('#inputImage').change(function(){    
        let reader = new FileReader();
     
        reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
        }   
      
        reader.readAsDataURL(this.files[0]); 
       
    });
      
    /*------------------------------------------
    --------------------------------------------
    Form Submit Event
    --------------------------------------------
    --------------------------------------------*/
    $('#image-upload').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $('#image-input-error').text('');
    
           $.ajax({
                type:'POST',
                url: "{{ route('image.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(response){
                    $('#image-upload').find(".print-error-msg").find("ul").html('');
                    $('#image-upload').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#image-upload').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });
    });
        
</script>
        
</html>