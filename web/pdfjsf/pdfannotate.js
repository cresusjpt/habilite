/**
 * PDFAnnotate v2.0.0
 * Author: Jeanpaul Tossou
 */

var PDFAnnotate = function (container_id, url,args) {
    this.number_of_pages = 0;
    this.pages_rendered = 0;
    this.active_tool = 1; // 1 - Free hand, 2 - Text, 3 - Arrow, 4 - Rectangle, 5 - Image
    this.fabricObjects = [];
    this.color = '#212121';
    this.borderColor = '#000000';
    this.borderSize = 1;
    this.font_size = 20;
    this.active_canvas = 0;
    this.container_id = container_id;
    this.url = url;
    this.args = args;
    var inst = this;

    var loadingTask = PDFJS.getDocument(this.url);
    loadingTask.promise.then(function (pdf) {
        var scale = 1.3;
        inst.number_of_pages = pdf.pdfInfo.numPages;

        for (var i = 1; i <= pdf.pdfInfo.numPages; i++) {
            pdf.getPage(i).then(function (page) {
                var viewport = page.getViewport(scale);
                var canvas = document.createElement('canvas');
                document.getElementById(inst.container_id).appendChild(canvas);
                canvas.className = 'pdf-canvas';
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                context = canvas.getContext('2d');

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.then(function () {
                    $('.pdf-canvas').each(function (index, el) {
                        $(el).attr('id', 'page-' + (index + 1) + '-canvas');
                    });
                    inst.pages_rendered++;
                    if (inst.pages_rendered == inst.number_of_pages) inst.initFabric();
                });
            });
        }
    }, function (reason) {
        console.error(reason);
    });

    this.initFabric = function () {
        var inst = this;
        $('#' + inst.container_id + ' canvas').each(function (index, el) {
            var background = el.toDataURL("image/png");
            var fabricObj = new fabric.Canvas(el.id, {
                freeDrawingBrush: {
                    width: 1,
                    color: inst.color
                }
            });
            inst.fabricObjects.push(fabricObj);
            fabricObj.setBackgroundImage(background, fabricObj.renderAll.bind(fabricObj));
            $(fabricObj.upperCanvasEl).click(function (event) {
                inst.active_canvas = index;
                inst.fabricClickHandler(event, fabricObj);
            });
        });
    }

    this.fabricClickHandler = function (event, fabricObj) {
        var inst = this;
        if (inst.active_tool == 2) {
            let name = document.getElementById('labelName').textContent;
            let today = new Date();
            let date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
            let final_output_name = "" + date + "\n" + name;
            var text = new fabric.IText(final_output_name, {
                left: event.clientX - fabricObj.upperCanvasEl.getBoundingClientRect().left,
                top: event.clientY - fabricObj.upperCanvasEl.getBoundingClientRect().top,
                fill: inst.color,
                fontSize: inst.font_size,
                selectable: true
            });
            fabricObj.add(text);
            inst.active_tool = 0;
        }
    }
}

PDFAnnotate.prototype.enableSelector = function () {
    var inst = this;
    inst.active_tool = 0;
    if (inst.fabricObjects.length > 0) {
        $.each(inst.fabricObjects, function (index, fabricObj) {
            fabricObj.isDrawingMode = false;
        });
    }
}

PDFAnnotate.prototype.enablePencil = function () {
    var inst = this;
    inst.active_tool = 1;
    if (inst.fabricObjects.length > 0) {
        $.each(inst.fabricObjects, function (index, fabricObj) {
            fabricObj.isDrawingMode = true;
        });
    }
}

PDFAnnotate.prototype.enableAddText = function () {
    var inst = this;
    inst.active_tool = 2;
    if (inst.fabricObjects.length > 0) {
        $.each(inst.fabricObjects, function (index, fabricObj) {
            fabricObj.isDrawingMode = false;
        });
    }
}

PDFAnnotate.prototype.enableRectangle = function () {
    var inst = this;
    var fabricObj = inst.fabricObjects[inst.active_canvas];
    inst.active_tool = 4;
    if (inst.fabricObjects.length > 0) {
        $.each(inst.fabricObjects, function (index, fabricObj) {
            fabricObj.isDrawingMode = false;
        });
    }

    var rect = new fabric.Rect({
        width: 100,
        height: 100,
        fill: inst.color,
        stroke: inst.borderColor,
        strokeSize: inst.borderSize
    });
    fabricObj.add(rect);
}

PDFAnnotate.prototype.enableImage = function () {
    var inst = this;
    var fabricObj = inst.fabricObjects[inst.active_canvas];
    inst.active_tool = 5;
    if (inst.fabricObjects.length > 0) {
        $.each(inst.fabricObjects, function (index, fabricObj) {
            fabricObj.isDrawingMode = false;
        });
    }

    var imgElement = document.getElementsByClassName('imgSrc')[0];
    var image = new fabric.Image(imgElement, {
        top : 0,
        left : 0,
        /*left: imgElement.width,
        top: imgElement.height,*/
        width: imgElement.width,
        height : imgElement.height,
        scaleX: 0.5,
        scaleY: 0.5,
    });
    fabricObj.add(image);
}

PDFAnnotate.prototype.enableAddArrow = function () {
    var inst = this;
    inst.active_tool = 3;
    if (inst.fabricObjects.length > 0) {
        $.each(inst.fabricObjects, function (index, fabricObj) {
            fabricObj.isDrawingMode = false;
            new Arrow(fabricObj, inst.color, function () {
                inst.active_tool = 0;
            });
        });
    }
}

PDFAnnotate.prototype.deleteSelectedObject = function () {
    var inst = this;
    var activeObject = inst.fabricObjects[inst.active_canvas].getActiveObject();
    if (activeObject) {
        if (confirm('Supprimer vraiment l\'élement ?')) inst.fabricObjects[inst.active_canvas].remove(activeObject);
    }
}

PDFAnnotate.prototype.savePdf = function () {
    $.blockUI({
        message : '<i class="fa fa-spinner fa-spin"></i> Veuillez patientez quelques secondes...'
    });
    var inst = this;
    var doc = new jsPDF();
    $.each(inst.fabricObjects, function (index, fabricObj) {
        if (index != 0) {
            doc.addPage();
            doc.setPage(index + 1);
        }
        doc.addImage(fabricObj.toDataURL(), 'png', 0, 0,undefined,undefined,undefined,'FAST');
    });
    var blob = doc.output('blob');
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var formData = new FormData();
    var controller = '/niveau/valid-update'
    var posturl = this.args.hurl+controller;
    console.log(posturl);
    formData.append('pdf', blob);
    formData.append('_csrf',csrfToken);
    formData.append('id_demande',this.args.id);
    formData.append('identifiant',this.args.identifiant);
    $.ajax(posturl, {
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            $.unblockUI();
            return true;
        },
        error: function (data) {
            event.preventDefault();
            console.log('error');
            console.log(data);
            $.unblockUI();
        }
    });

}

PDFAnnotate.prototype.setBrushSize = function (size) {
    var inst = this;
    $.each(inst.fabricObjects, function (index, fabricObj) {
        fabricObj.freeDrawingBrush.width = size;
    });
}

PDFAnnotate.prototype.setColor = function (color) {
    var inst = this;
    inst.color = color;
    $.each(inst.fabricObjects, function (index, fabricObj) {
        fabricObj.freeDrawingBrush.color = color;
    });
}

PDFAnnotate.prototype.setBorderColor = function (color) {
    var inst = this;
    inst.borderColor = color;
}

PDFAnnotate.prototype.setFontSize = function (size) {
    this.font_size = size;
}

PDFAnnotate.prototype.setBorderSize = function (size) {
    this.borderSize = size;
}

PDFAnnotate.prototype.clearActivePage = function () {
    var inst = this;
    var fabricObj = inst.fabricObjects[inst.active_canvas];
    var bg = fabricObj.backgroundImage;
    if (confirm('La page active va être néttoyer! Continuer ? ')) {
        fabricObj.clear();
        fabricObj.setBackgroundImage(bg, fabricObj.renderAll.bind(fabricObj));
    }
}

PDFAnnotate.prototype.serializePdf = function () {
    var inst = this;
    return JSON.stringify(inst.fabricObjects, null, 4);
}


PDFAnnotate.prototype.loadFromJSON = function (jsonData) {
    var inst = this;
    $.each(inst.fabricObjects, function (index, fabricObj) {
        if (jsonData.length > index) {
            fabricObj.loadFromJSON(jsonData[index])
        }
    })
}
