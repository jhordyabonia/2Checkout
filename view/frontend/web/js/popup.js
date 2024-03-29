require([
    'jquery',
    'sweetalert',
],
  function($,ui,sw){    
    local = false;
    formResult=null;
    sendForm = function(form,_success){
      var t;
      var data="{";
      for(t=0; t<form.elements.length;t++)
        data+='"'+form.elements[t].name+'":"'+form.elements[t].value+'",';
      data+='"order_id":"'+t+'",';
	    data+='"items":'+t+'}';

      $.ajax({
        url: BASE_URL+'2checkout',
        data: JSON.parse(data),
        type: 'post',
        success: _success
      });     

    }
    makeDataShipp=function(t){

      ship=window.checkoutConfig.selectedShippingMethod;
      shipping = $('<div>')[0];

      type_  =  $("<input />",{type:'hidden',name:'li_'+t+'_type',value:'shipping'});
      name_  =  $('<input />',{type:'hidden',name:'li_'+t+'_name',value:ship.carrier_title});
      price_ =  $('<input />',{type:'hidden',name:'li_'+t+'_price',value:ship.price_incl_tax});


      card_holder_name= $("<input />",{type:'hidden', name:'card_holder_name', value:''})[0];
      street_address= $("<input />",{type:'hidden', name:'street_address', value:'' })[0];
      street_address2= $("<input />",{type:'hidden', name:'street_address2', value:'' })[0];
      city= $("<input />",{type:'hidden', name:'city', value:''})[0];
      state= $("<input />",{type:'hidden', name:'state', value:''})[0];
      country= $("<input />",{type:'hidden', name:'country', value:''})[0];
      email= $("<input />",{type:'hidden', name:'email', value:'' })[0];
      phone= $("<input />",{type:'hidden', name:'phone', value:'' })[0];
      phone_extension= $("<input />",{type:'hidden', name:'phone_extension', value:'' })[0];
      ship_name= $("<input />",{type:'hidden', name:'ship_name', value:'' })[0];
      ship_street_address= $("<input />",{type:'hidden', name:'ship_street_address', value:'' })[0];
      ship_street_address2= $("<input />",{type:'hidden', name:'ship_street_address2', value:'' })[0];
      ship_city= $("<input />",{type:'hidden', name:'ship_city', value:'' })[0];
      ship_state= $("<input />",{type:'hidden', name:'ship_state', value:'' })[0];
      ship_zip= $("<input />",{type:'hidden', name:'ship_zip', value:'' })[0];
      ship_country= $("<input />",{type:'hidden', name:'ship_country', value:'' })[0];

      customer=checkoutConfig.customerData
      if(window.isCustomerLoggedIn){
        dataShipp=dataBill=null;
        for(var c=0; c<customer.addresses.length; c++){
            if(customer.addresses[c].id==customer.default_billing)
              dataBill=customer.addresses[c];
            if(customer.addresses[c].id==customer.default_shipping)
              dataShipp=customer.addresses[c];
        }
        card_holder_name= $("<input />",{type:'hidden', name:'card_holder_name', value:customer.firstname+" "+customer.lastnanme})[0];
        email= $("<input />",{type:'hidden', name:'email', value:customer.email })[0];
        if(dataBill!=null){
          street_address= $("<input />",{type:'hidden', name:'street_address', value:dataBill.street[0] })[0];
          street_address2= $("<input />",{type:'hidden', name:'street_address2', value:dataBill.street[1] })[0];
          city= $("<input />",{type:'hidden', name:'city', value:dataBill.city })[0];
          state= $("<input />",{type:'hidden', name:'state', value:dataBill.region.region})[0];
          country= $("<input />",{type:'hidden', name:'country', value:dataBill.country_id})[0];
          phone= $("<input />",{type:'hidden', name:'phone', value:dataBill.telephone })[0];
          phone_extension= $("<input />",{type:'hidden', name:'phone_extension', value:'' })[0];
        }
        if(dataShipp!=null){
          ship_name= $("<input />",{type:'hidden', name:'ship_name', value:ship.carrier_title })[0];
          ship_street_address= $("<input />",{type:'hidden', name:'ship_street_address', value:dataShipp.street[0] })[0];
          ship_street_address2= $("<input />",{type:'hidden', name:'ship_street_address2', value:dataShipp.street[1] })[0];
          ship_city= $("<input />",{type:'hidden', name:'ship_city', value:dataShipp.city })[0];
          ship_state= $("<input />",{type:'hidden', name:'ship_state', value:dataShipp.region.region })[0];
          ship_zip= $("<input />",{type:'hidden', name:'ship_zip', value:dataShipp.postcode })[0];
          ship_country= $("<input />",{type:'hidden', name:'ship_country', value:dataShipp.country_id })[0];
        }
        
      }
      shipping.append(type_[0]);
      shipping.append(name_[0]);
      shipping.append(price_[0]);
      
      shipping.append(card_holder_name);
      shipping.append(street_address);
      shipping.append(street_address2);
      shipping.append(city);
      shipping.append(state);
      shipping.append(country);
      shipping.append(email);
      shipping.append(phone);
      shipping.append(phone_extension);
      shipping.append(ship_name);
      shipping.append(ship_street_address);
      shipping.append(ship_street_address2);
      shipping.append(ship_city);
      shipping.append(ship_state);
      shipping.append(ship_zip);
      shipping.append(ship_country);
      
      return shipping;

    }
    makeForm=function(){
      var t;

      url_2Checkout=BASE_URL+'2checkout';//'https://sandbox.2checkout.com/checkout/purchase';
      account_2Checkout=111111111;

      form  = $('<form>',{target:'_blank',id:'r75',method:'post',action:url_2Checkout})[0];
      sid   = $("<input type='hidden' name='sid' value='"+account_2Checkout+"'/>")[0];
      mode  = $("<input type='hidden' name='mode' value='2CO'/>")[0];
      form.append(sid);
      form.append(mode);

      items=window.checkoutConfig.quoteItemData;
      for(t=0;t<items.length;t++){
        form.append(makeItem(t,items[t].sku,items[t].name,items[t].qty,items[t].price_incl_tax));
      }     
      try{
        form.append(makeDataShipp(t));
      }catch(e){console.log(e);}
      //submit =  $('<input />',{id:'send_form',type:'submit',name:'submit',value:'Checkout',style:'display:none'});
      //form.append(submit[0]);

      return form;
    }
    makeItem=function(index,_id,_name,_qty,_price){
      out = $('<div>')[0];      
      
      type_  =  $("<input />",{type:'hidden',name:'li_'+index+'_type',value:'product'});
      name_  =  $('<input />',{type:'hidden',name:'li_'+index+'_name',value:_name});
      price_ =  $('<input />',{type:'hidden',name:'li_'+index+'_price',value:(""+_price).replace('.0000','')});
      qty_   =  $('<input />',{type:'hidden',name:'li_'+index+'_quantity',value:_qty});
      
      out.append(type_[0]);
      out.append(name_[0]);
      out.append(price_[0]);
      out.append(qty_[0]);
      
      return out;
    }

    showPopup = function(){
      div = $('<div id="form_2checkout"></div>');
      div.html($('#_form_2checkout').html());
      swal( "¡2Checkout Payment!",{
        content: div[0],
        button: {
          text: 'Place Order',
          closeModal: true,
        }
      });
      $('.btn-x').on('click', function(){
        $('.swal-overlay')[0].click();
      });
      //close popup
      $(".swal-button--confirm").on('click',function(){
          content=$('#checkmo').closest('div').closest('div');
          $(content[0].parentElement)
          .find('button[class="action primary checkout"]') 
          .trigger('click');              
          }
      );
      //close popup
    }
   
    ready = function(){
      if($('#checkout2')[0] instanceof Object){     
          content=$('#checkout2').closest('div').closest('div');
          $(content[0].parentElement).find('button[class="action primary checkout"]').hide();
          div=$('<div style="margin-bottom: 25px;"></div>');
          button= $('<div class="action primary" style="float:right;"></div>');
          button.html(' <span data-bind="i18n: \'Place Order\'" class="po2checkout">Place Order</span>');
          //button.on('click',showPopup);
          button.on('click',function(){
            if(!local){ 
              sendForm($('#r75')[0],function(res) { 
                obj=JSON.parse(res);
                if(obj.success){
                  $(content[0].parentElement)
                  .find('button[class="action primary checkout"]')
                  .trigger('click');
                }
              });
            }else{
              content=$('#checkmo').closest('div').closest('div');
              $(content[0].parentElement)
                .find('button[class="action primary checkout"]') 
                .trigger('click'); 
            } 
          });
          

          if(local){            
            _div = $('<div id="form_2checkout"></div>');
            _div.html($('#_form_2checkout').html());
            $(content[0].parentElement).find('div[class="payment-method-content"]')[0].append(_div[0]); 
          }

          form=makeForm();
          div[0].append(form);
          div[0].append(button[0]);
          $(content[0].parentElement).find('div[class="payment-method-content"]')[0].append(div[0]);     

       }else setTimeout(ready,1000);
   }
   $(document).ready(ready);
  }
);   
