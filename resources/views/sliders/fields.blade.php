@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Description Field -->
<div class="form-group row ">
  {!! Form::label('description', trans("lang.slider_description"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('description', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slider_description_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.slider_description_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Image Field -->
<div class="form-group row">
  {!! Form::label('image', trans("lang.slider_image"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <div style="width: 100%" class="dropzone image" id="image" data-field="image">
      <input type="hidden" name="image">
    </div>
    <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
    <div class="form-text text-muted w-50">
      {{ trans("lang.slider_image_help") }}
    </div>
  </div>
</div>
@prepend('scripts')
<script type="text/javascript">
    var var15899345341781240039ble = '';
    @if(isset($slider) && $slider->hasMedia('image'))
    var15899345341781240039ble = {
        name: "{!! $slider->getFirstMedia('image')->name !!}",
        size: "{!! $slider->getFirstMedia('image')->size !!}",
        type: "{!! $slider->getFirstMedia('image')->mime_type !!}",
        collection_name: "{!! $slider->getFirstMedia('image')->collection_name !!}"};
    @endif
    var dz_var15899345341781240039ble = $(".dropzone.image").dropzone({
        url: "{!!url('uploads/store')!!}",
        addRemoveLinks: true,
        maxFiles: 1,
        init: function () {
        @if(isset($slider) && $slider->hasMedia('image'))
            dzInit(this,var15899345341781240039ble,'{!! url($slider->getFirstMediaUrl('image','thumb')) !!}')
        @endif
        },
        accept: function(file, done) {
            dzAccept(file,done,this.element,"{!!config('medialibrary.icons_folder')!!}");
        },
        sending: function (file, xhr, formData) {
            dzSending(this,file,formData,'{!! csrf_token() !!}');
        },
        maxfilesexceeded: function (file) {
            dz_var15899345341781240039ble[0].mockFile = '';
            dzMaxfile(this,file);
        },
        complete: function (file) {
            dzComplete(this, file, var15899345341781240039ble, dz_var15899345341781240039ble[0].mockFile);
            dz_var15899345341781240039ble[0].mockFile = file;
        },
        removedfile: function (file) {
            dzRemoveFile(
                file, var15899345341781240039ble, '{!! url("sliders/remove-media") !!}',
                'image', '{!! isset($slider) ? $slider->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
            );
        }
    });
    dz_var15899345341781240039ble[0].mockFile = var15899345341781240039ble;
    dropzoneFields['image'] = dz_var15899345341781240039ble;
</script>
@endprepend
</div>
@if($customFields)
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
  {!! $customFields !!}
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.slider')}}</button>
  <a href="{!! route('sliders.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
