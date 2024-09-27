function initializeFilePond(selector, allowMultiple, acceptedFileTypes, url) {
    var filepondElement = document.querySelector(selector);
    var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var fileIds = [];

    var filePond = FilePond.create(filepondElement, {
        allowMultiple: allowMultiple,
        labelIdle: 'Drag & Drop your files or <span class="filepond--label-action">Browse</span>',
        acceptedFileTypes: acceptedFileTypes,
        fileValidateTypeLabelExpectedTypes: 'Expects {allTypes}',
        server: {
            process: {
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                onload: (response) => {
                    fileIds.push(response);
                },
                onerror: (error) => {
                    console.error('Error:', error);
                }
            }
        },
        instantUpload: false,
        allowRevert: false
    });

    return { filePond, fileIds };
}