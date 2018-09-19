var amc_pid;
var amc_is_select;

$(document).ready(function () {
    if ($('#useaccountinfo').length)
    {
        $('#useaccountinfo').change(function () {
            if ($(this).prop('checked'))
            {
				$.each($('.billing_input_req'), function(index, value){
					$(this).removeAttr('required');
				});
				$('.billing-cont').hide();
                $('.billing-action').removeClass('amc-billing-open');
                $('.billing-action').addClass('amc-billing-close');
            }
            else
            {
				$.each($('.billing_input_req'), function(index, value){
					$(this).attr('required','required');
				});
				$('.billing-cont').show();
                $('.billing-action').removeClass('amc-billing-close');
                $('.billing-action').addClass('amc-billing-open');
            }
        })
    }
	if ($('#location-pickup').length)
	{
		$( "#location-pickup" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					url: "/api/search/location",
                    dataType: "json",
                    html: true,
					data: {
                        location: request.term,
                        company_id: $('#company_id').val()
					},
					success: function( data ) {
						response( $.map( data.data, function( item ) {
							return {
                                label: (item.city != '' ? '<b>' + item.name + '</b>, ' + item.country + ', ' + item.state + ', ' + item.city + ', ' + item.address + ' - ' + item.phone + ', OAG:' + item.area_code : '<b>'+item.name + '</b> OAG:' + item.area_code),
								value: item.name,
								id: item.area_code
							}
						}));
					}
				});
      		},
			minLength: 3,
			select: function( event, ui ) {
				$('#location-pickup-value').val(ui.item.id);
                $('#location-pickup').val(ui.item.value);
                if ($('#location-dropoff-value').val() == '')
                {
                    $('#location-dropoff-value').val(ui.item.id);
                    $('#location-dropoff').val(ui.item.value);
                }
      		}
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<a>" + item.label + "</a>")
                .appendTo(ul);
        };

    }
	if ($('#location-dropoff').length)
	{
		$( "#location-dropoff" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					url: "/api/search/location",
					dataType: "json",
					data: {
						location: request.term
					},
					success: function( data ) {
						response( $.map( data.data, function( item ) {
							return {
                                label: (item.city != '' ? '<b>' + item.name + '</b>, ' + item.country + ', ' + item.state + ', ' + item.city + ', ' + item.address + ' - ' + item.phone + ', OAG:' + item.area_code : '<b>' + item.name + '</b> OAG:' + item.area_code),
								value: item.name,
								id: item.area_code
							}
						}));
					}
				});
      		},
			minLength: 3,
			select: function( event, ui ) {
				$('#location-dropoff-value').val(ui.item.id);
				$('#location-dropoff').val(ui.item.label);
      		}
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<a>" + item.label + "</a>")
                .appendTo(ul);
        };
	}
	if ($('.home-checkbox'))
	{
		$('.home-checkbox').change(function() {
			var values = new Array();
			$.each($(".home-checkbox:checked"), function() {
				values.push($(this).val());
			});
			console.log(values);
			if (values.length)
			{
			$.ajax( {
				url: "/api/search/ratecode",
                dataType: "json",
                method:'post',
				data: {
                    packages: values,
                    company_id: $('#company_id').val()
				},
				success: function( data ) {
					data=data.data;
					var html='';
					if (data.ratecodes.length)
					{
						var html='<ul>';
						for(var i=0;i<data.ratecodes.length;i++)
						{
							html+='<li class="amc_qtip" title="'+data.ratecodes[i].name+'" alt="'+data.ratecodes[i].description+'">';
							html+='	<input type="radio" class="home-checkbox ratecode-radio" id="home-radio'+data.ratecodes[i].id+'" name="ratecode" value="'+data.ratecodes[i].id+'"/>';
							html+='	<label for="home-radio'+data.ratecodes[i].id+'">'+data.ratecodes[i].name+'</label>';
							html+='</li>';
						}

						html+='</ul>';
						$(".result_code").empty();
						$(".result_code").append(html);
						$(".result_code_cont > .p2-title").text('Please select code:');
						$('.result_code>ul>.amc_qtip').qtip({
							content: {
								text: function(event, api) {
									return $(this).attr('alt');
								},
								title: function(event, api) {
									return ''+$(this).attr('title');
								}
							},
							position: {
								my: 'top left',  // Position my top left...
								at: 'bottom left' // at the bottom right of...
							},
							style: {
								classes: 'qtip-light qtip-rounded'
							}
						});

					}
					else
					{
						$(".result_code").empty();
						$(".result_code_cont > .p2-title").text('Code not found yet');
					}
				}
			});
			}
			else
			{
				$(".result_code").empty();
				$(".result_code_cont > .p2-title").text('Code not found yet');
			}
	    });
	}
	if ($('#form-step2').length)
	{
		$('#form-step2').submit(function() {
			if ($(".ratecode-radio:checked").length)
			{
				$("#ratecode").val($(".ratecode-radio:checked").val());
			}
			else
			{
				$("#ratecode").val('');
				alert('You need select code');
				return false;
			}
		  // your code here
		});
	}
    if ($('.catalog-block').length) {
        findcars();
	}

	//logic for package
    $(".package").bind("click", function(e) {
        amc_pid = $(this).attr("rel");
        amc_is_select = $("#package"+amc_pid+":checked").length>0;
        console.log(amc_pid,amc_is_select)
    }).bind("change", function(e) {
        if (amc_is_select==false)
        {
            if (amc_pid==7||amc_pid==6)
            {
                if (($("#package6").prop( "checked")||$("#package7").prop( "checked")))
                    $( "#package4" ).prop( "checked", true );
                else
                    $( "#package4" ).prop( "checked", false );
            }
            if (amc_pid==4)
            {
                if (($("#package6").prop( "checked")||$("#package7").prop( "checked")))
                    $( "#package4" ).prop( "checked", true );
                else
                    $( "#package4" ).prop( "checked", false );
            }

        }
        else
        {
            if (amc_pid==7||amc_pid==6)
            {
                $( "#package4" ).prop( "checked", true );
            }
        }
    });
	
    $(".package_div").bind("click", function(e) {
        amc_pid = $(this).attr("rel");
        amc_is_select = $("#fl-radio"+amc_pid+":checked").length>0;
        console.log(amc_pid,amc_is_select)
    }).bind("change", function(e) {
        if (amc_is_select==false)
        {
            if (amc_pid==7||amc_pid==6)
            {
                if (($("#fl-radio6").prop( "checked")||$("#fl-radio7").prop( "checked")))
                    $( "#fl-radio4" ).prop( "checked", true );
                else
                    $( "#fl-radio4" ).prop( "checked", false );
            }
            if (amc_pid==4)
            {
                if (($("#fl-radio6").prop( "checked")||$("#fl-radio7").prop( "checked")))
                    $( "#fl-radio4" ).prop( "checked", true );
                else
                    $( "#fl-radio4" ).prop( "checked", false );
            }

        }
        else
        {
            if (amc_pid==7||amc_pid==6)
            {
                $( "#fl-radio4" ).prop( "checked", true );
            }
        }
    });

});
function dontshowspalsh(cb)
{
	var name='amc_dontshowspalsh';
	if ($(cb).is(':checked'))
	{
		amc_createCookie(name,"1",365);
	}
	else
	{
		amc_createCookie(name,"",-1);
	}
}
function amc_createCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}
function changestate(country_id)
{
			$.ajax( {
				url: "/api/search/states",
                dataType: "json",
                method:'post',
				data: {
                    country_id: country_id
				},
				success: function( data ) {
					data=data.data;
					var html='';
					var idx=0;
					if (data.states.length>0)
					{
						html+='<option value="">Select state</option>';
						for(var i=0;i<data.states.length;i++)
						{
							if (data.states[i].name!='')
							{
								idx++;
								html+='<option value="'+data.states[i].id+'">'+data.states[i].name+'</option>';
							}
						}

					}
					else
					{
						html+='<option value="0">No state for this country</option>';
					}
					if (idx==0)
						html='<option value="0">No state for this country</option>';
					$("#billing_state_id").empty();
					$("#billing_state_id").append(html);
					$('#billing_state_id').trigger('refresh');
				}
			});

}

function changestateaccount(country_id) {
    $.ajax({
        url: "/api/search/states",
        dataType: "json",
        method: 'post',
        data: {
            country_id: country_id
        },
        success: function (data) {
            data = data.data;
            var html = '';
            var idx = 0;
            if (data.states.length > 0) {
                html += '<option value="">Select state</option>';
                for (var i = 0; i < data.states.length; i++) {
                    if (data.states[i].name != '') {
                        idx++;
                        html += '<option value="' + data.states[i].id + '">' + data.states[i].name + '</option>';
                    }
                }

            }
            else {
                html += '<option value="0">No state for this country</option>';
            }
            if (idx == 0)
                html = '<option value="0">No state for this country</option>';
            $("#account_state_id").empty();
            $("#account_state_id").append(html);
            $('#account_state_id').trigger('refresh');
        }
    });

}
function billingformsubmit()
{
	$('#billingformbtn').click();

}
function openfilters()
{
    $('.filter-layer-bg').css('display', 'block');
    $('.filter-layer').css('display', 'block');
}
function closefilters(withreload) {
    if (withreload)
    {
        findcars();
    }
    $('.filter-layer-bg').css('display', 'none');
    $('.filter-layer').css('display', 'none');

}
function findcars()
{
    var html = '<div class="search-error"><h2>Please wait... we are searching for the best car for you!<h2></div>';
    $('.catalog-block').empty();
    $('.catalog-block').append(html);
    var packages = [];
    var companies = [];
    $('.companies:checked').each(function () {
        companies.push($(this).attr('value'));
    });
    $('.packages:checked').each(function () {
        packages.push($(this).attr('value'));
    });
    $.ajax({
        url: "/api/search/cars",
        dataType: "json",
        method: 'post',
        data: {
            companies: companies,
            packages: packages,
            csrfToken:window.Laravel.csrfToken,
            driverlicence: $('#driverlicence').val(),
            locationpickupvalue: $('#location-pickup-value').val(),
            locationdropoffvalue:$('#location-dropoff-value').val(),
            datepickupvalue:$('#date-pickup-value').val(),
            datedropoffvalue:$('#date-dropoff-value').val(),
        },
        success: function (data) {
            data = data.data;
            $('.catalog-block').empty();
            $('.catalog-block').append(data.car_html);
            $('.amc_qtip_res').qtip({
                content: {
                    text: function (event, api) {
                        return $(this).attr('alt');
                    },
                    title: function (event, api) {
                        return '' + $(this).attr('title');
                    }
                },
                position: {
                    my: 'top left',  // Position my top left...
                    at: 'bottom left' // at the bottom right of...
                },
                style: {
                    classes: 'qtip-light qtip-rounded'
                }
            });

        }
    });

}