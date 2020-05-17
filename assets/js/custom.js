document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelector('#helpmodal');
    const instances = M.Modal.init(elems);

    const select = document.querySelectorAll('select');
    const ins = M.FormSelect.init(select);
});