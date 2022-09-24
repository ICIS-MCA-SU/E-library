<?php include_once 'header.php' ?>
<script src='PDFJSExpress-viewer/lib/webviewer.min.js'></script>
<script src='PDFJSExpress-viewer/licenseConfig.js'></script>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<style>
    .pdf-page {
        max-width: 800px;
        max-height: 100%;
        overflow: hidden !important;
        ;
        position: relative;
        margin-left: auto !important;
        margin-right: auto !important;
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    /* inner wrapper: make responsive */
    .pdf-page .object {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 70vh;

        margin: 0;
        padding: 0;
        border: none;
        /* gets height from padding-bottom */

        /* put following styles (necessary for overflow and scrolling handling on mobile devices) inline in .responsive-wrapper around iframe because not stable in CSS:
    -webkit-overflow-scrolling: touch; overflow: auto; */
    }
</style>

<body x-data="pdfView">
    <div class="my-3 mx-2">
        <div id='viewer' style="width:100%;height:100vh;margin:0" auto></div>

        <!-- <object x-bind:data="pdfUrl" type="application/pdf" width="100%" class="object">
            <embed src="https://drive.google.com/file/d/1CRFdbp6uBDE-YKJFaqRm4uy9Z4wgMS7H/preview?usp=sharing" width="100%" class="embed" />
        </object> -->
    </div>
    <script>
        let pdfView = () => {
            return {
                pdfUrl: "books/pdf/",
                init() {
                    const params = new URLSearchParams(window.location.search)
                    this.pdfUrl = this.pdfUrl + params.get("pdf");
                }
            }
        };
        const params = new URLSearchParams(window.location.search)
        let pdfUrl = "books/pdf/" + params.get("pdf");
        WebViewer({
                path: 'PDFJSExpress-viewer/lib',
                licenseKey: licenseConfig.licenseKey,
                initialDoc: pdfUrl,
                disabledElements: [
                    'viewControlsButton',
                    'viewControlsOverlay',
                    "menuButton",
                    "searchButton",
                    "toolsButton",
                    "panToolButton",
                    "selectToolButton",
                    "freeHandToolGroupButton",
                    "textToolGroupButton",
                    "shapeToolGroupButton",
                    "eraserToolButton",
                    "signatureToolGroupButton",
                    "freeTextToolButton",
                    "stickyToolButton",
                    "miscToolGroupButton",
                    "toolsButton",
                    "textPopup", "contextMenuPopup"
                ]
                
            }, document.getElementById('viewer'))
            .then(instance => {
            
                const {
                    Core,
                    UI
                } = instance;
                Core.documentViewer.addEventListener('documentLoaded', () => {
                    console.log('document loaded');
                    instance.disableFeatures([instance.Feature.TextSelection])
                });

                // adding an event listener for when the page number has changed
                Core.documentViewer.addEventListener('pageNumberUpdated', (pageNumber) => {
                    // console.log(`Page number is: ${pageNumber}`);
                });
                instance.UI.disableFeatures([instance.UI.Feature.Print]);
            });
    </script>
</body>

<?php include_once 'footer.php' ?>