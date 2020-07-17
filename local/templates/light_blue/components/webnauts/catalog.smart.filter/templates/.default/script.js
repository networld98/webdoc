if (typeof(BX.CustomFilterClass) === 'undefined')
{
    BX.CustomFilterClass = function(selector, event)
    {
        this._selector = selector;
        this._event = event;
        this._element = document.querySelectorAll(this._selector);

        let keys = Object.keys(this._element);
        for (let key of keys) {
            this._element[key].onchange = function(){
                let currentUrl = new URL(location.href);
                let curGetParams = BX.CustomFilterClass.getsParams(currentUrl.search);
                let keys = Object.keys(curGetParams);
                for (let key of keys) {
                    if(key.substring(0, 6) === 'PAGEN_') {
                        currentUrl.searchParams.delete(key);
                        history.pushState(null, null, currentUrl.href);

                    }
                }
                this._fields = document.querySelectorAll('.filterEl .filter-field');

                let fields = {ajax: 'Y'};
                keys = Object.keys(this._fields);
                for (let key of keys) {

                    field = this._fields[key];


                    if(field.tagName === 'INPUT') {
                        if(field.checked === true) {
                            fields[field.name] = 'Y';
                        } else {
                            fields[field.name] = 'N';
                        }
                    } else if(field.value) {
                        fields[field.name] = field.value;
                    }
                }

                let ajaxUrl = currentUrl.href;

                BX.ajax({
                    url: ajaxUrl,
                    method: 'POST',
                    data: fields,

                    onsuccess: function(result) {
                        BX.CustomPagenClass.unbindEvents('.page-link');
                        BX.adjust(BX('list'), {html: result});
                        BX.CustomPagenClass.create('.page-link', 'click');
                    }
                });

            };
        }


    };

    BX.CustomFilterClass.getsParams = function(getParams) {
        if (!getParams) return false;
        let a = getParams;
        let b = {};
        a = a.substring(1).split("&");
        for (let i = 0; i < a.length; i++) {
            c = a[i].split("=");
            b[c[0]] = c[1];
        }
        return b;
    };

    BX.CustomFilterClass.create = function(selector, event)
    {
        _self = new BX.CustomFilterClass(selector, event);
        return _self;
    };

}

BX.ready(function(){
    BX.CustomFilterClass.create('.filter-field', 'change');
});
