@extends('layouts.superadmin')
@section('content')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js" referrerpolicy="origin"></script>
<div id="content">
  <div id="content-header">
    <!-- <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">Add Coupon</a> </div> -->
    <h1>Add Email Template</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <!-- <h5>Add Email Template</h5> -->
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('superadmin/add-email-template') }}" name="add_coupon" id="add_coupon">{{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" maxlength="15" minlength="5" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Content</label>
                <div class="controls">
                   <textarea cols="80" id="editor1" name="content" rows="10" data-sample-short>&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href=&quot;https://ckeditor.com/&quot;&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>
                </div>
              </div>

               


              <div class="form-actions">
                <input type="submit" value="Add Coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <script>
    tinymce.init({
          selector: "#editor1",
          menubar : false,
          visual: false,
          height:600,
          inline_styles : true,
          plugins: [
               "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
               "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
               "save table directionality emoticons template paste fullpage code legacyoutput"
         ],
         content_css: "css/content.css",
         toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage table | forecolor backcolor emoticons | preview | code",
         fullpage_default_encoding: "UTF-8",
         fullpage_default_doctype: "<!DOCTYPE html>",
         init_instance_callback: function (editor) 
         {
          editor.on('Change', function (e) {
              if ($('.save-draft').hasClass('disabled')){
            $('.save-draft').removeClass('disabled').text('Save Draft');
          }
          });

          if (localStorage.getItem(templateID) !== null) {
          editor.setContent(localStorage.getItem(templateID));
        }

        setTimeout(function(){ 
          editor.execCommand("mceRepaint");
        }, 2000);

        }
      });
    </script>
@endsection