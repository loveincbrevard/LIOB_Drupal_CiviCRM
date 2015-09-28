(function ($) {
Drupal.behaviors.loveincbrevard = {
  attach: function (context, settings) {
			$(window).load( function(){set_time_completed_in_minutes();});
			$(".month.form-select").change(function(){set_time_completed_in_minutes();}); 
			$(".day.form-select").change(function(){set_time_completed_in_minutes();});
			$(".year.form-select").change(function(){set_time_completed_in_minutes();});
			$(".hour.form-select").change(function(){set_time_completed_in_minutes();});
			$(".minute.form-select").change(function(){set_time_completed_in_minutes();}); 
			$(".form-item-submitted-civicrm-1-activity-1-activity-activity-date-time-timepart-ampm").change(function(){set_time_completed_in_minutes($(this));});
			$(".form-item-submitted-activity-end-time-ampm").change(function(){set_time_completed_in_minutes($(this));});
			$("#webform-client-form-2").submit(function() {
         return set_time_completed_in_minutes();
      });
			
			function set_time_completed_in_minutes() {
					var startDateTimeYear =  $("#edit-submitted-civicrm-1-activity-1-activity-activity-date-time-year").val();
					var startDateTimeMonth = $("#edit-submitted-civicrm-1-activity-1-activity-activity-date-time-month").val();
					var startDateTimeDay = $("#edit-submitted-civicrm-1-activity-1-activity-activity-date-time-day").val();
					var startDateTimeHour = $("#edit-submitted-civicrm-1-activity-1-activity-activity-date-time-timepart-hour").val();
					var startDateTimeMinute = $("#edit-submitted-civicrm-1-activity-1-activity-activity-date-time-timepart-minute").val();
				  if($("#edit-submitted-civicrm-1-activity-1-activity-activity-date-time-timepart-ampm-am").is(":checked")) {
				  	if (parseInt(startDateTimeHour) == 12) startDateTimeHour = 0;
				  } else { 
				  	if (parseInt(startDateTimeHour) < 12) 
				  	startDateTimeHour = parseInt(startDateTimeHour) + 12;
				  }
				  var startDateTime = new Date(startDateTimeYear,startDateTimeMonth,startDateTimeDay,startDateTimeHour,startDateTimeMinute);
					var endDateTimeYear =  $("#edit-submitted-activity-end-date-year").val();
					var endDateTimeMonth = $("#edit-submitted-activity-end-date-month").val();
					var endDateTimeDay = $("#edit-submitted-activity-end-date-day").val();
					var endDateTimeHour = $("#edit-submitted-activity-end-time-hour").val();
					var endDateTimeMinute = $("#edit-submitted-activity-end-time-minute").val();
				  if($("#edit-submitted-activity-end-time-ampm-am").is(":checked")) {
				  	if (parseInt(endDateTimeHour) == 12) 
				  		endDateTimeHour = 0;
				  } else { 
				  	if (parseInt(endDateTimeHour) < 12) 
				  		endDateTimeHour = parseInt(endDateTimeHour) + 12;
				  }
			  	var endDateTime = new Date(endDateTimeYear,endDateTimeMonth,endDateTimeDay,endDateTimeHour,endDateTimeMinute);
			  	totalMinutes = (endDateTime.getTime() - startDateTime.getTime()) / 60000; 
			  	$("#edit-submitted-civicrm-1-activity-1-cg10-custom-47").val(totalMinutes);
			  	$("#edit-submitted-total-time").val((Math.floor(totalMinutes / 60) + " hours " + Math.floor(totalMinutes % 60) + " mins."));
			  	if (totalMinutes < 0) { 
			  		alert("Activity End Date Time is earlier than Activity Start Date Time.  Please correct before submitting.");
			  		return false;
			  	}
			  	return true;
			}
		}
	};
}(jQuery));