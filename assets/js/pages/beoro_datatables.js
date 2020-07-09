/* [ ---- Beoro Admin - datatables ---- ] */

    $(document).ready(function() {
        //* datatables
        beoro_datatables.basic();
        beoro_datatables.hScroll();
        beoro_datatables.colReorder_visibility();
        
		$('.dataTables_filter input').each(function() {
		$(this).attr("placeholder", "Enter search terms here");
        })
    });

    //* datatables
    beoro_datatables = {
        basic: function() {
            if($('#dt_basic').length) {
                $('#dt_basic').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }
        },
        //* horizontal scroll
        hScroll: function() {
            if($('#dt_hScroll').length) {
                $('#dt_hScroll').dataTable({
                "sScrollX": "100%",
                "sScrollXInner": '100%',
                "sPaginationType": "bootstrap",
                "bScrollCollapse": true 
            });
            }
			 if($('#accounts').length) {
                $('#accounts').dataTable({
                "sScrollX": "100%",
                "sScrollXInner": '100%',
                "sPaginationType": "bootstrap",
                "bScrollCollapse": true 
            });
            }
        },
        //* column reorder & toggle visibility
        colReorder_visibility: function() {
            if($('#dt_colVis_Reorder').length) {
                $('#dt_colVis_Reorder').dataTable({
                    "sPaginationType": "bootstrap",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row-fluid'ip>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-mini btn-inverse').html('Columns');
                    }
                });
            }
        }
    };