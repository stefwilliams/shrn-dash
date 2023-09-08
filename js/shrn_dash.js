jQuery( document ).ready(function() {

 
 jQuery("#shrn_dash").LoadingOverlay("show", {
    background: "rgba(255, 255, 255, 1)"
  });
  // $("#shrn_dash").hide();


  // Introduce a short delay before running the checkAndApplyScroll function
  // setTimeout(function() {
  checkAndApplyScroll();
  // }, 100); // Adjust the delay as needed



  jQuery(".h-tab_content").hide();
  jQuery(".h-tab_content:first").show();

  jQuery(".h-tab_tab-head li").click(function () {

    jQuery(".h-tab_content").hide();
    var activeTab = jQuery(this).attr("rel");
    jQuery("#" + activeTab).fadeIn();

    var activeSubTab = jQuery('#' + activeTab).find('li.active').attr("rel");
    jQuery('#' + activeSubTab).fadeIn();

    jQuery(".h-tab_tab-head li").removeClass("active");
    jQuery(this).addClass("active");

  });


  jQuery(".v-tab_content").hide();
  jQuery(".v-tab_content:first").show();

  jQuery(".v-tab_tab-head li").click(function () {

    jQuery(".v-tab_content").hide();
    var activeTab = jQuery(this).attr("rel");
    jQuery("#" + activeTab).fadeIn();
    jQuery(this).siblings().removeClass("active");
    jQuery(this).addClass("active");
  });
  jQuery(".radio_select:not(.radio0)").hide();
  jQuery('input[type="radio"]').click(function () {
    var inputValue = jQuery(this).attr("value");
    var targetBox = jQuery("." + inputValue);
    jQuery(".radio_select").not(targetBox).hide();
    jQuery(targetBox).show();
  });

  setTimeout(function() {
    jQuery(".h-tab_container").css("visibility", "visible");
    }, 500); 
  jQuery("#shrn_dash").LoadingOverlay("hide");
  // $("#shrn_dash").LoadingOverlay("hide");

});


function checkAndApplyScroll() {
  // Temporarily make the elements visible
  const scrollers = document.querySelectorAll('.scroller');
  scrollers.forEach((scroller) => {

    const isInitiallyHidden = window.getComputedStyle(scroller).display === 'none';
    if (isInitiallyHidden) {
      scroller.style.display = 'block'; // Or use 'inline-block', depending on your layout
    }

    // Calculate and apply the "scroll" class if needed
    if (scroller.scrollWidth > scroller.clientWidth) {
      scroller.classList.add('scroll');
    }

    // Hide the element again if it was initially hidden
    if (isInitiallyHidden) {
      scroller.style.display = 'none';
    }
  });
}
