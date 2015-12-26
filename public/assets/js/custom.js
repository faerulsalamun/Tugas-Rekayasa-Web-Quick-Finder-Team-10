/**
 * Created by faerulsalamun on 12/20/15.
 */

jQuery.noConflict()(function($) {
  $(document).ready(function() {

    var quickFinder = {
      el: {},

      /**
       * Cache element variable
       */
      setupElements: function() {
        this.el.$fromCity = $('#from-city');
        this.el.$fromCityId = $('#from-city-id');
      },

      /**
       * Event Binding
       */
      eventBinding: function() {
        //this.el.$buttonDeleteMessageSubjectButton.on('click', '', $.proxy(this.deleteMessageSubject, this));
      },

      // Get data city
      getDataCity: function() {
        var self = this;

        //var options = {
        //
        //  url: function(phrase) {
        //    return root.baseUrl + 'index.php/quickfinder/getCity';
        //  },
        //
        //  getValue: function(element) {
        //    return element.name;
        //  },
        //
        //  ajaxSettings: {
        //    dataType: 'json',
        //    method: 'GET',
        //    data: {
        //      dataType: 'json',
        //    },
        //  },
        //
        //  preparePostData: function(data) {
        //    data.phrase = _this.el.$fromCity.val();
        //    return data;
        //  },
        //
        //  requestDelay: 400,
        //};

        var options = {
          data: ["Jakarta", "Bandung", "Surabaya", "Semarang", "Medan"]
        };

        self.el.$fromCity.easyAutocomplete(options);

        //$.ajax({
        //  url: root.baseUrl + 'index.php/quickfinder/getCity',
        //  type: 'GET',
        //  success: function(data) {
        //    _this.el.$fromCity.autocomplete({
        //      source:data,
        //      select: function(e, ui) {
        //        e.preventDefault();
        //        this.el.$fromCityId.val(ui.item.id);
        //
        //        $(this).val(ui.item.name);
        //      },
        //    });
        //  },
        //});
      },

      /**
       * Initialization
       */
      init: function() {
        this.setupElements();
        this.eventBinding();
      },

    };

    quickFinder.init();
    quickFinder.getDataCity();

  });
});
