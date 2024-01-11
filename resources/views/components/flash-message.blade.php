{{-- Create Success Message --}}
@if(Session('success') || Session('toggled'))
<div class="p-6 px-4">
    <div id="alert" role="alert" class="alert alert-success text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>{{ Session('success') ? Session('success') : Session('toggled') }}</span>
      <button class="btn btn-sm" id="closeBtn">Close</button>
    </div>
</div>

<script>
  document.getElementById('closeBtn').addEventListener('click', function() {
    document.getElementById('alert').style.display = 'none';
  });
</script>
@endif


{{-- Update Success Message --}}
@if(Session('updated'))
<div class="p-6 px-4">
    <div id="alert" role="alert" class="alert alert-success text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>{{ Session('updated') }}</span>
      <button class="btn btn-sm" id="closeBtn">Close</button>
    </div>
</div>

    <script>
    document.getElementById('closeBtn').addEventListener('click', function() {
      document.getElementById('alert').style.display = 'none';
    });
  </script>
@endif


{{-- Delete Success Message --}}
@if(Session('deleted'))
<div class="p-6 px-4">
    <div id="alert" role="alert" class="alert alert-success text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>{{ Session('deleted') }}</span>
      <button class="btn btn-sm" id="closeBtn">Close</button>
    </div>
</div>

<script>
    document.getElementById('closeBtn').addEventListener('click', function() {
      document.getElementById('alert').style.display = 'none';
    });
  </script>
@endif


{{-- error --}}
@if(Session('error'))
<div class="p-6 px-4">
    <div id="alert" role="alert" class="alert alert-error text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>{{ Session('error') }}</span>
      <button class="btn btn-sm" id="closeBtn">Close</button>
    </div>
</div>

<script>
    document.getElementById('closeBtn').addEventListener('click', function() {
      document.getElementById('alert').style.display = 'none';
    });
  </script>
@endif
