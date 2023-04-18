@extends('dashboard/layouts/master')
@section('content')
<style>
    body {
  /* align-items: center; */
  background-color: #000;
  /* display: flex; */
  justify-content: center;
  /* height: 100vh; */
}

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  /* height: 500px; */
  padding: 20px;
  width: 500px;
  margin-left:32% ;
  margin-top:50px ;
}

.title {
  color: #eee;
  font-family: sans-serif;
  font-size: 36px;
  font-weight: 600;
  margin-top: 30px;
}

.subtitle {
  color: #eee;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: 600;
  margin-top: 10px;
}

.input-container {
  height: 50px;
  position: relative;
  width: 100%;
}

.ic1 {
  margin-top: 40px;
}

.ic2 {
  margin-top: 30px;
}

.input {
  background-color: #303245;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  font-size: 18px;
  height: 100%;
  outline: 0;
  padding: 4px 20px 0;
  width: 100%;
}

.cut {
  background-color: #15172b;
  border-radius: 10px;
  height: 20px;
  left: 20px;
  position: absolute;
  top: -20px;
  transform: translateY(0);
  transition: transform 200ms;
  width: 76px;
}

.cut-short {
  width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}

.placeholder {
  color: #65657b;
  font-family: sans-serif;
  left: 20px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;
  top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
  transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
  color: #808097;
}

.input:focus ~ .placeholder {
  color: #dc2f55;
}

.submit {
  background-color: #08d;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  // outline: 0;
  text-align: center;
  width: 100%;
}

.submit:active {
  background-color: #06b;
}

</style>

<div class="form">
    <div class="title">Welcome</div>
    <div class="subtitle">Let's create new company!</div>
    
     <form action="{{route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

    <div class="input-container ic1">
      <input class="input" type="text" placeholder=" " name="name"/>
      <div class="cut"></div>
      <label for="name" class="placeholder" >Company name</label>
    </div>
    @error('name')
    <div class="alert alert-danger mt-1 mb-1" style="color:white">{{ $message }}</div>
    @enderror


    <div class="input-container ic2">
      <input class="input" type="email" placeholder=" " name="email"/>
      <div class="cut"></div>
      <label for="email" type="email" class="placeholder" >email</label>
    </div>
    @error('email')
    <div class="alert alert-danger mt-1 mb-1" style="color:white">{{ $message }}</div>
    @enderror


    <div class="input-container ic2">
      <input class="input" type="text" placeholder=" " name="website"/>
      <div class="cut cut-short"></div>
      <label for="website" class="placeholder" >website</>
    </div>
    @error('website')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror


    <div class="input-container ic2" style="color:white">
        <input type="file" name="logo" value="fileupload" id="fileupload"> 
        <label for="fileupload"> Select a logo image</label> <br>
        {{-- <div class="cut cut-short"></div> --}}
        {{-- <label for="website" class="placeholder" name="website">logo</label> --}}
      </div>
      @error('logo')
      <div class="alert alert-danger mt-1 mb-1" style="color:white">{{ $message }}</div>
      @enderror



    <button type="submit" class="submit" name="submit">Create</button>
 
</form>
</div>
  @if(session('status'))
  <div class="alert alert-success mb-1 mt-1" style="color:white">
      {{ session('status') }}
  </div>
  @endif
@endsection