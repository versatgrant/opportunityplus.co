        $(function () {
            var kanbanCol = $('.panel-body');
            kanbanCol.css('max-height', (window.innerHeight - 150) + 'px');
            /*ADDED BY NICHOLAS GRANT*/

            $.each(kanbanCol, function(){
                var headerfooterHeight = $(this).next('.panel-footer').css('height');
                var bodyHeight = $(this).css('height');
                headerfooterHeight = parseInt(headerfooterHeight.replace( /^\D+/g, '')) * 2;
                bodyHeight = parseInt(bodyHeight.replace( /^\D+/g, ''));
                var milestoneHeight = (headerfooterHeight + bodyHeight) + 'px';
                $(this).parent().css('height', milestoneHeight);
            });
            /*ADDED BY NICHOLAS GRANT*/

            var kanbanColCount = parseInt(kanbanCol.length);
            $('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

            draggableInit();

            /*$('.panel-heading').click(function() {
                var $panelBody = $(this).parent().children('.panel-body');
                $panelBody.slideToggle();
            });*/
        });

        function draggableInit() {
            var sourceId;

            $('[draggable=true]').bind('dragstart', function (event) {
                sourceId = $(this).parent().attr('id');
                event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
            });

            $('.panel-body').bind('dragover', function (event) {
                event.preventDefault();
            });

            $('.panel-body').bind('drop', function (event) {
                var children = $(this).children();
                var targetId = children.attr('id');

                if (sourceId != targetId) {
                    var elementId = event.originalEvent.dataTransfer.getData("text/plain");

                    $('#processing-modal').modal('toggle'); //before post


                    // Post data 
                    setTimeout(function () {
                        var element = document.getElementById(elementId);
                        children.prepend(element);
                        $('#processing-modal').modal('toggle'); // after post
                    }, 1000);

                }

                event.preventDefault();
            });
        }
