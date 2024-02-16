@if (session()->has('success'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show" style="position: fixed; background-color: #e75e8d; color: black; padding: 0.5rem 1rem; border-radius: 0.5rem; bottom: 2rem; right: 3rem; font-size: 0.875rem; z-index: 9999;">
      <strong><p>{{ session('success') }}</p></strong>
    </div>
@endif