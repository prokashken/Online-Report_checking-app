@extends('layout.app')
@section('title')
ONLINE X-RAY REPORT:: Patient Edit
@endsection
@section('upper-headline')
<h5>{{Auth::user()->medicals[0]->medical_centre_name}} | ID: {{Auth::user()->medicals[0]->medical_centre_id}}</h5>
@endsection
@section('content')
    <div class="br-section-wrapper">
        <h6 class="br-section-label" style="text-align:center;">Edit Patient</h6>
        @if (session('status'))
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
          </div>
        @endif
        <form action="{{url("/patient/$patient->id")}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-xl-12">
              <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Patient Info</h6>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Patient ID: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="patient_id" value="{{$patient->patient_id}}" class="form-control @error('patient_id') is-invalid @enderror" placeholder="Enter Patient Id" required>
                    @error('patient_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div><!-- row -->
                <div class="row row mg-t-20">
                    <label class="col-md-3 label-control">View Report</label>
                    <div class="col-md-9">
                      <?php $dcmfile = 'public/decomfiles/' . $patient->patient_id . '.dcm' ?>
                      {{-- @dd($dcmfile) --}}
                      <input class="form-control" type="text" hidden id="wadoURL" name="d" placeholder="Enter WADO URL"
                        value=<?php echo $dcmfile ?>>

                      {{-- <button type="button" id="downloadAndView" class="btn btn-outline-primary"
                        data-toggle="modal" data-target="#default" onclick="downloadAndView()">
                        Click here to view patient report
                      </button> --}}
                    </div>
                </div>
                <div class="row row mg-t-20">
                    <!-- <div class="col-md-3"></div> -->
                    <!-- <div  class="col-md-9"> -->
                    <div class="col-md-12">
                      <div id="rpt">
                        <div
                          style="width:700px;height:700px;position:relative;color: white;display:inline-block;border-style:solid;border-color:black;"
                          oncontextmenu="return false" class='disable-selection noIbar' unselectable='on'
                          onselectstart='return false;' onmousedown='return false;'>
                          <div id="dicomImage"
                            style="width:700px;height:700px;top:0px;left:0px; position:absolute">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--<div  class="col-md-3"></div>-->
                  </div> 
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Patient Name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="patient_name" value="{{$patient->patient_name}}" class="form-control @error('patient_name') is-invalid @enderror" placeholder="Enter Medical Patient Name" required>
                    @error('patient_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Patient Passport Number: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="patient_passport" value="{{$patient->patient_passport}}" class="form-control @error('patient_passport') is-invalid @enderror" placeholder="Enter Patient Passport Number" required>
                    @error('patient_passport')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Patient Date Of Birth: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input class="form-control @error('patient_dob') is-invalid @enderror" type="text" value="{{$patient->patient_dob}}" name="patient_dob" placeholder="Enter Patient DOB" required>
                    @error('patient_dob')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                  <button class="btn btn-info">Submit Form</button>
                  <a href='{{asset("/patients")}}' style="color:white;" class="btn btn-secondary">Cancel</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div><!-- col-6 -->
          </div>
        </form>   
    </div>
@endsection

@push('script')
<script src="{{asset('public/jssz/cornerstone.min.js')}}"></script>
<script src="{{asset('public/jssz/cornerstoneMath.min.js')}}"></script>
<script src="{{asset('public/jssz/cornerstoneTools.min.js')}}"></script>
<script src="{{asset('public/jssz/dicomParser.min.js')}}"></script>
<script src="{{asset('public/jssz/cornerstoneWADOImageLoader.bundle.min.js')}}"></script>
<script>window.cornerstoneWADOImageLoader || document.write('<script src="https://unpkg.com/cornerstone-wado-image-loader">\x3C/script>')</script>
<script src="{{asset('public/jssz/customWebWorkersConfig.js')}}"></script>
<script>
  $(document).ready(function () {
    $("#rpt").hide();
    if ($("#doc_status").val() === 'Fit') {
      $("#remarks").hide();
    } else {
      $("#remarks").show();
    }
  });
  $('select[name=doc_status]').on('change', function () {
    if (this.value == 'Fit') {
      $("#remarks").hide();
    } else {
      $("#remarks").show();
    }
  });
</script>

<script>
  config = window.customWebWorkerConfig;

  cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
  cornerstoneWADOImageLoader.webWorkerManager.initialize(config);

  let loaded = false;
  let loadedImage;

  function loadAndViewImage(imageId) {
    const element = document.getElementById('dicomImage');
    try {
      const start = new Date().getTime();
      cornerstone.loadAndCacheImage(imageId).then(function (image) {
        console.log(image);
        loadedImage = image;
        const viewport = cornerstone.getDefaultViewportForImage(element, image);
        cornerstone.displayImage(element, image, viewport);



        // display dicom metadata start
        // Access the metadata and patient information

        var patientName = image.data.string('x00100010');
        var patientID = image.data.string('x00100020');
        var patientAge = image.data.string('x00101010');
        var patientSex = image.data.string('x00100040');
        var patientStudyDate = image.data.string('x00080020');
        var patientModality = image.data.string('x00080060');
        var patientStudyDesc = image.data.string('x00081030');
        // Study Description
        var patientImageDate = image.data.string('x00080033');
        var patientViewPosition = image.data.string('x00185101');
        var patientViewPassword = image.data.string('x00080050');
        var patientViewMedicalCenterName = image.data.string('x00080080');


        var idOverlay = document.createElement('div');
        idOverlay.className = 'cornerstone-overlay';
        idOverlay.style.position = 'absolute';
        idOverlay.style.top = '10px';
        idOverlay.style.left = '10px';
        idOverlay.style.color = 'white';
        idOverlay.style.fontFamily = 'Arial';
        idOverlay.style.fontSize = '16px';

        idOverlay.textContent = patientID;
        element.appendChild(idOverlay);

        var nameOverlay = document.createElement('div');
        nameOverlay.className = 'cornerstone-overlay';
        nameOverlay.style.position = 'absolute';
        nameOverlay.style.top = '30px';
        nameOverlay.style.left = '10px';
        nameOverlay.style.color = 'white';
        nameOverlay.style.fontFamily = 'Arial';
        nameOverlay.style.fontSize = '16px';

        nameOverlay.textContent = patientName;
        element.appendChild(nameOverlay);

        var sexOverlay = document.createElement('div');
        sexOverlay.className = 'cornerstone-overlay';
        sexOverlay.style.position = 'absolute';
        sexOverlay.style.top = '50px';
        sexOverlay.style.left = '10px';
        sexOverlay.style.color = 'white';
        sexOverlay.style.fontFamily = 'Arial';
        sexOverlay.style.fontSize = '16px';

        sexOverlay.textContent = patientSex;
        element.appendChild(sexOverlay);

        var ageOverlay = document.createElement('div');
        ageOverlay.className = 'cornerstone-overlay';
        ageOverlay.style.position = 'absolute';
        ageOverlay.style.top = '70px';
        ageOverlay.style.left = '10px';
        ageOverlay.style.color = 'white';
        ageOverlay.style.fontFamily = 'Arial';
        ageOverlay.style.fontSize = '16px';

        ageOverlay.textContent = patientAge;
        element.appendChild(ageOverlay);


        // right side
        var studyDescOverlay = document.createElement('div');
        studyDescOverlay.className = 'cornerstone-overlay';
        studyDescOverlay.style.position = 'absolute';
        studyDescOverlay.style.top = '10px';
        studyDescOverlay.style.right = '10px';
        studyDescOverlay.style.color = 'white';
        studyDescOverlay.style.fontFamily = 'Arial';
        studyDescOverlay.style.fontSize = '16px';

        studyDescOverlay.textContent = patientStudyDesc + ' ' + patientViewPosition;
        element.appendChild(studyDescOverlay);

        var viewPassword = document.createElement('div');
        viewPassword.className = 'cornerstone-overlay';
        viewPassword.style.position = 'absolute';
        viewPassword.style.top = '30px';
        viewPassword.style.right = '10px';
        viewPassword.style.color = 'white';
        viewPassword.style.fontFamily = 'Arial';
        viewPassword.style.fontSize = '16px';

        viewPassword.textContent = patientViewPassword;
        element.appendChild(viewPassword);

        var year = patientStudyDate.slice(0, 4);
        var month = patientStudyDate.slice(4, 6);
        var day = patientStudyDate.slice(6, 8);

        var date = new Date(year, month - 1, day);
        var formattedDate = date.toLocaleDateString("en-GB", {
          day: "2-digit",
          month: "short",
          year: "numeric"
        });

        var studyDateOverlay = document.createElement('div');
        studyDateOverlay.className = 'cornerstone-overlay';
        studyDateOverlay.style.position = 'absolute';
        studyDateOverlay.style.top = '50px';
        studyDateOverlay.style.right = '10px';
        studyDateOverlay.style.color = 'white';
        studyDateOverlay.style.fontFamily = 'Arial';
        studyDateOverlay.style.fontSize = '16px';

        studyDateOverlay.textContent = formattedDate;
        element.appendChild(studyDateOverlay);

        var imageDateOverlay = document.createElement('div');
        imageDateOverlay.className = 'cornerstone-overlay';
        imageDateOverlay.style.position = 'absolute';
        imageDateOverlay.style.top = '70px';
        imageDateOverlay.style.right = '10px';
        imageDateOverlay.style.color = 'white';
        imageDateOverlay.style.fontFamily = 'Arial';
        imageDateOverlay.style.fontSize = '16px';

        var formattedTime = patientImageDate.substring(0, 2) + ":" + patientImageDate.substring(2, 4) + ":" + patientImageDate.substring(4, 6);
        imageDateOverlay.textContent = 'Acq: ' + formattedTime;
        element.appendChild(imageDateOverlay);

        var viewPositionOverlay = document.createElement('div');
        viewPositionOverlay.className = 'cornerstone-overlay';
        viewPositionOverlay.style.position = 'absolute';
        viewPositionOverlay.style.top = '90px';
        viewPositionOverlay.style.right = '10px';
        viewPositionOverlay.style.color = 'white';
        viewPositionOverlay.style.fontFamily = 'Arial';
        viewPositionOverlay.style.fontSize = '16px';

        viewPositionOverlay.textContent = 'Lat/Pos: -/' + patientViewPosition;
        element.appendChild(viewPositionOverlay);

        var viewMedicalCenter = document.createElement('div');
        viewMedicalCenter.className = 'cornerstone-overlay';
        viewMedicalCenter.style.position = 'absolute';
        viewMedicalCenter.style.bottom = '10px';
        viewMedicalCenter.style.right = '10px';
        viewMedicalCenter.style.color = 'white';
        viewMedicalCenter.style.fontFamily = 'Arial';
        viewMedicalCenter.style.fontSize = '16px';

        viewMedicalCenter.textContent = patientViewMedicalCenterName;
        element.appendChild(viewMedicalCenter);

        // display dicom metadata end


        if (loaded === false) {
          cornerstoneTools.mouseInput.enable(element);
          cornerstoneTools.mouseWheelInput.enable(element);
          cornerstoneTools.wwwc.activate(element, 1); // ww/wc is the default tool for left mouse button
          cornerstoneTools.pan.activate(element, 2); // pan is the default tool for middle mouse button
          cornerstoneTools.zoom.activate(element, 4); // zoom is the default tool for right mouse button
          cornerstoneTools.zoomWheel.activate(element); // zoom is the default tool for middle mouse wheel
          loaded = true;
        }

      }, function (err) {
        //alert(err);
        $("#rpt").hide();
        alert('Report not found!');
      });
    }
    catch (err) {
      //alert(err);
      $("#rpt").hide();
      alert('Report not found!');
    }

  }
  
  $(document).ready(()=>{
      console.log('try');
      downloadAndView();
      console.log('catch');
  })

  function downloadAndView() {
    var d1 = new Date('2023-06-15'); //yyyy-mm-dd
    var d2 = new Date();
    // 		if(d1<d2){
    // 			return;
    // 		}
    let url = document.getElementById('wadoURL').value;
    url = "wadouri:" + url;
    $("#rpt").show();
    loadAndViewImage(url);
  }

  function getUrlWithoutFrame() {
    const url = document.getElementById('wadoURL').value;
    const frameIndex = url.indexOf('frame=');
    if (frameIndex !== -1) {
      url = url.substr(0, frameIndex - 1);
    }
    return url;
  }

  var sleepTaskLoaded = false;

  function startWebWorker() {
    if (!sleepTaskLoaded) {
      sleepTaskLoaded = true;
      cornerstoneWADOImageLoader.webWorkerManager.loadWebWorkerTask(
        `${window.location.protocol}//${window.location.host}/report/sleepTask.js`, {
        'sleepTask': {
          sleepTime: 3000
        }
      }
      );
    }

    const task = cornerstoneWADOImageLoader.webWorkerManager.addTask('sleepTask', {}, -10);
    const promise = task.promise;
    promise.then(function (result) {
      console.log('sleep task completed');
    });
  }

  const element = document.getElementById('dicomImage');
  cornerstone.enable(element);

  document.getElementById('downloadAndView').addEventListener('click', function (e) {
    downloadAndView();
  });

  function convolute(kernel, multiplier, calculateWWWC) {
    const promise = cornerstoneWADOImageLoader.webWorkerManager.addTask('convolveTask', {
      pixelData: loadedImage.getPixelData(),
      kernel: kernel,
      multiplier: multiplier,
      imageFrame: {
        typedArrayName: loadedImage.getPixelData().constructor.name,
        width: loadedImage.width,
        height: loadedImage.height
      }
    }, -8).promise;
    promise.then(function (result) {
      console.log('convolveTask task completed');
      result.pixelData = new Int16Array(result.pixelData);

      const sharpenedImage = {
        color: false,
        columns: loadedImage.columns,
        rows: loadedImage.rows,
        width: loadedImage.width,
        height: loadedImage.height,
        imageId: new Date().toISOString(),
        maxPixelValue: result.minMax.max,
        minPixelValue: result.minMax.min,
        windowWidth: calculateWWWC ? (result.minMax.max - result.minMax.max) : loadedImage.windowWidth,
        windowLevel: calculateWWWC ? ((result.minMax.max + result.minMax.max) / 2) : loadedImage.windowLevel,
        sizeInBytes: loadedImage.sizeInBytes,
        render: loadedImage.render,
        slope: loadedImage.slope,
        intercept: loadedImage.intercept,
        invert: loadedImage.invert,
        getPixelData: function () {
          return result.pixelData;
        }
      };

      cornerstone.displayImage(element, sharpenedImage);
      loadedImage = sharpenedImage;
    });
  }

  $('.form-actions').on('click', '.btn.btn-warning.mr-1', function (e) {
    window.history.back();
  });
</script>
@endpush