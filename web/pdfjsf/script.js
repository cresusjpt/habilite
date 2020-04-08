var Niveau = Niveau || (function () {
    var _args = {};
    var pdf = {};
    return {
        init : function (Args) {
            _args = Args;
            const annotate_need = {
                id : _args.demande,
                identifiant : _args.identifiant,
                hurl : _args.hurl,
            };
            pdf = new PDFAnnotate('pdf-container', _args.file,annotate_need);
            $(function () {
                $('.color-tool').click(function () {
                    $('.color-tool.active').removeClass('active');
                    $(this).addClass('active');
                    color = $(this).get(0).style.backgroundColor;
                    pdf.setColor(color);
                });

                $('#brush-size').change(function () {
                    var width = $(this).val();
                    pdf.setBrushSize(width);
                });

                $('#font-size').change(function () {
                    var font_size = $(this).val();
                    pdf.setFontSize(font_size);
                });
            });

            $(document).ready(function () {
                $('#signImg').attr('src',_args.image);
                $('#labelName').text(_args.name);
            });

            $('#form_valid').submit(function () {
                $.blockUI({
                    message : '<i class="fa fa-spinner fa-spin"></i> Veuillez patientez quelques secondes...'
                });
                $('#savebt').click();
                //return true;
            });
        },

        authenticateUser: function(event){
            bootbox.dialog({
                message: "Entrer votre mot de passe: <input type='password' id='first_name'>",
                title: _args.name,
                buttons: {
                    main: {
                        label: "Enrégistrer",
                        className: "btn-primary",
                        callback: function() {
                            $.blockUI({
                                message : '<i class="fa fa-spinner fa-spin"></i> Veuillez patientez quelques secondes...'
                            });
                            let murl = _args.hurl+'/niveau/authenticate-signer';
                            var csrfToken = $('meta[name="csrf-token"]').attr("content");
                            $.post(murl,{_csrf : csrfToken, password : $('#first_name').val()},function (data) {
                                console.log(data)
                                if (data === true ) {
                                    Niveau.enableImage(event);
                                    $.unblockUI();
                                }else {
                                    bootbox.alert('Mot de passe incorrect !');
                                    $.unblockUI();
                                }
                            });
                        }
                    }
                }
            });
        },

        enableSelector : function(event) {
            event.preventDefault();
            var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
            $('.tool-button.active').removeClass('active');
            $(element).addClass('active');
            pdf.enableSelector();
        },

        enablePencil : function(event) {
            event.preventDefault();
            var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
            $('.tool-button.active').removeClass('active');
            $(element).addClass('active');
            pdf.enablePencil();
        },

        enableAddText : function(event) {
            event.preventDefault();
            var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
            $('.tool-button.active').removeClass('active');
            $(element).addClass('active');
            pdf.enableAddText();
        },

        enableAddArrow : function(event) {
            event.preventDefault();
            var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
            $('.tool-button.active').removeClass('active');
            $(element).addClass('active');
            pdf.enableAddArrow();
        },

        enableRectangle : function(event) {
            event.preventDefault();
            var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
            $('.tool-button.active').removeClass('active');
            $(element).addClass('active');
            pdf.setColor('rgba(255, 0, 0, 0.3)');
            pdf.setBorderColor('blue');
            pdf.enableRectangle();
        },

        enableImage : function(event) {
            event.preventDefault();
            var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
            $('.tool-button.active').removeClass('active');
            $(element).addClass('active');
            pdf.setColor('rgba(255, 0, 0, 0.3)');
            pdf.setBorderColor('blue');
            pdf.enableImage();
        },

        deleteSelectedObject : function() {
            event.preventDefault();
            pdf.deleteSelectedObject();
        },

        savePDF : function() {
            pdf.savePdf();
        },

        clearPage : function() {
            pdf.clearActivePage();
        },

        showPdfData : function() {
            var string = pdf.serializePdf();
            $('#dataModal .modal-body pre').first().text(string);
            PR.prettyPrint();
            $('#dataModal').modal('show');
        }
    };

}());


