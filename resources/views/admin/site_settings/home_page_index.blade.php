@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="ps-2">Home Page Settings</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end pe-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home Page Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card py-4">
        <form action="{{ url('admin/site_setting/home_page_store') }}" method="POST">
            @csrf
            <div class="header-text px-4">
                <h4>Header Text</h4>
                <div id="loader" class="placeholder-glow">
                    <span class="placeholder col-12 placeholder-lg"></span>
                    <span class="placeholder col-12 placeholder-lg"></span>
                    <span class="placeholder col-12 placeholder-lg"></span>
                    <span class="placeholder col-12 placeholder-lg"></span>
                </div>
                <textarea name="header_text" id="editor" style="display: none">
                    {{ $site_settings->get('header_text') }}
                </textarea>
            </div>
            <hr class="my-5">
            <div class="steps px-4">
                <h4>Review Steps</h4>
                @if($site_settings->get('steps'))
                    @foreach (json_decode($site_settings->get('steps')) as $step_number => $step_description)
                        <div class="mb-3">
                            <label class="form-label">Step {{ $loop->iteration }}</label>
                            <textarea class="form-control" name="step[{{ $step_number }}]">{{ $step_description }}</textarea>
                        </div>
                    @endforeach
                @else
                    @for($step = 1; $step < 5; $step++)
                        <label class="form-label">Step {{ $step }}</label>
                        <textarea class="form-control" name="step[{{ $step }}]"></textarea>
                    @endfor
                @endif
            </div>
            <hr class="my-5">
            <div class="header-text px-4">
                <h4>About Renter</h4>
                <textarea name="about_renter" class="form-control">{{ $site_settings->get('about_renter') }}</textarea>
            </div>
            <hr class="my-5">
            <div class="header-text px-4">
                <h4>Renter Say</h4>
                <textarea name="renter_say" class="form-control">{{ $site_settings->get('renter_say') }}</textarea>
            </div>
            <hr class="my-5">
            <div class="text-end px-4">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            toolbar: {
                items: [
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline','removeFormat', '|',
                    'bulletedList', 'numberedList',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        }).then(function (editor) {
            $("#loader").hide();
        });
    </script>
@endsection