<div class="position-absolute top-0 end-0">
    <div class="toast" role="alert"
         aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <i class="ti me-1" style="font-size: 3rem"></i>
                <span name="message">message</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const toastTypes = {
            'success': {class: 'text-bg-success', iconClass: 'ti-check'},
            'error': {class: 'text-bg-danger', iconClass: 'ti-x'},
            'warning': {class: 'text-bg-warning', iconClass: 'ti-alert-triangle'},
            'info': {class: 'text-bg-info', iconClass: 'ti-info-circle'}
        };

        const toastElement = document.querySelector('.toast');
        const toastIcon = toastElement.querySelector('.ti');
        const toastBody = toastElement.querySelector('span[name="message"]');

        const myToast = new bootstrap.Toast(toastElement, {});

        window.livewire.on('toast', data => {
            const {type, message} = data;

            const toastType = toastTypes[type];
            if (toastType) {
                for (const t in toastTypes) {
                    if (toastTypes.hasOwnProperty(t)) {
                        toastElement.classList.remove(toastTypes[t].class);
                    }
                }

                toastElement.classList.add(toastType.class);
                toastIcon.classList = ['ti', toastType.iconClass].join(' ');

                toastBody.innerText = message;
                myToast.show();
            }
        });
    </script>
@endpush
