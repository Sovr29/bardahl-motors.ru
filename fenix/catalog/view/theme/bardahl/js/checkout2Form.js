/* you can ask me about this script by sending message via email to anatoliy.iwanov@yandex.ru
 * 
 */

    var pickup = false, 
            deliveryInCity = false, 
            deliveryToRegions = false,
            pickupData = "",
            deliveryData = "",
            pickupHeaderText,
            deliveryInCityHeaderText,
            phoneNumber,
            workTime,
            tupesOfPayment,
            paymentTypeTextForDelivery = "Наличными курьеру",
            cityName,
            selectedValue,
            pickupContent,
            deliveryInCityContent,
            deliveryToRegionsContent,
            paymentContent = "",
            allContent = "",
            urlDelVal;
    
    var typesOfPaymentObject = {
        pickup: {
            cash:{
                id: "payment-pickup-cash",
                siteId: "cheque",
                text: "Наличными в пункте выдачи",
                description: "Оплата наличными при самовывозе"
            },
            card:{
                id: "payment-pickup-card",
                siteId: "card",
                text: "Банковской картой в пункте выдачи",
                description: "Оплата картой при самовывозе"
            },
            online:{
                id: "payment-pickup-online",
                siteId: "unitpay",
                text: "С помощью системы онлайн платежей",
                description: "Оплата через систему онлайн платежей"
            }
        },
        delivery: {
            cash:{
                id: "payment-delivery-cash",
                siteId: "cheque",
                text: "Наличными курьеру",
                description: "Оплата наличными курьеру или транспортной компании"
                
            },
            online:{
                id: "payment-delivery-online",
                siteId: "unitpay",
                text: "Оплатить онлайн",
                description: "Оплата через систему онлайн платежей"
            }
        }
    }

    function initPaymentContent(radioValue, paymentdescription, checked){
        return "<tr> <td> <input type='radio' name='payMethod' class='payment_radio' value='"+ radioValue +"' "+ checked +" /> </td> <td> "+ paymentdescription +" </td> </tr>";
    }
    
    function initDeliveryContent(object, deliveryType){
        
        var length = Object.keys(object).length;
        var result = "";
        
        result += "<table class='table table-hover' id='deliveryTable'>";
        
        if(deliveryType === "pickup"){
                result += "<tr><th></th><th>Описание</th> <th>Режим работы</th> <th>Варианты оплаты</th> </tr>";
            for(var i = 0; i < length; i++){   
                result += "<tr class='checkout2Checked'> <td> <input type='radio' class='delivery_radio' name='shipping_method' id='"+ object[i]["id"] +"' value='"+ object[i]["siteId"] +"' /></td> <td>"+ object[i]["text"] + " <br> " + object[i]["phoneNumber"] +" </td> <td> "+ object[i]["workTime"] +"</td> <td>"+ object[i]["typesOfPaymentText"] + "</td></tr>";
            }
        }
        if(deliveryType === "delivery"){
                
                result += "<tr><th></th><th>Описание</th> <th>Стоимость</th> <th>Бесплатная доставка от</th> <th>Варианты оплаты</th> </tr>";
                
            for(var i = 0; i < length; i++){
                if(i === 0){
                    var checked = "checked";
                }
                else {
                    checked = "";
                }
                
                result += "<tr class='checkout2Checked'> <td> <input type='radio' class='delivery_radio' name='shipping_method' id='"+ object[i]["id"] +"' value='"+ object[i]["siteId"] +"' "+ checked +" /></td> <td> "+ object[i]["text"] + "</td> <td>" + object[i]["cost"] +" </td> <td>"+ object[i]["freeUntil"] +"</td> <td>"+ object[i]["paymentType"] + "</td> </tr>";
            }
        }
        if(deliveryType === "other"){
            
                result += "<tr><th></th><th>Описание</th> <th>Стоимость</th> <th>Бесплатная доставка от</th> </tr>";
            
            for(var i = 0; i < length; i++){
                if(i === 0){
                    var checked = "checked";
                }
                else {
                    checked = "";
                }
                result += "<tr class='checkout2Checked'> <td> <input type='radio' class='delivery_radio' name='shipping_method' id='"+ object[i]["id"] +"' value='"+ object[i]["siteId"] +"' "+ checked +" /> </td> <td>"+ object[i]["text"] + "</td> <td>" + object[i]["cost"] +"</td> <td>"+ object[i]["freeUntil"] +"</td> </tr>";
            }
        }
        
        result += "</table>";
        
        return result;
    }
    
    function checkout2BindShippingEvents(value){
        $.ajax({
            url: 'index.php?route=checkout2/shipping/shipping',
            type: 'get',
            data: 'shipping_method=' + value
        }).success(function () {
            $('.shipping_errors').html('');
            $.ajax({
                url: 'index.php?route=common/cart/info',
                type: 'get',
            }).success(function (data) {
                var cart = $('#cart');
                var parent = cart.parent();
                cart.remove();
                parent.append($(data));
            });

            $.ajax({
                url: 'index.php?route=common/cart/info&getTotal=1',
                type: 'get',
            }).success(function (data) {
                               
                $('.cartTotalPrice').html('');
                $('.cartTotalPrice').append($(data));
                $("#checkout2CartTotalPrice").html("");
                $("#checkout2CartTotalPrice").append($(data));
                
            });

        });
}

    $("#checkout2CustomerPhone").mask("+7 (999) 999-9999");
    
    var slickContainer = $(".checkout2_slider_conteiner");
    var checkOutForm = $("#checkout2Form");
    
    
    slickContainer.slick({
            accessibility: true,
            arrows: false,
            draggable: false
            
        });
    
    function initAllDeliveryContent(){
        selectedValue = $("option:selected").attr("value");
            pickupContent = "";
            deliveryInCityContent = "";
            deliveryToRegionsContent = "";
            
            // формировать объекты динамически
            switch(selectedValue){
            case "msk":
                pickup = true;
                deliveryInCity = true;
                deliveryToRegions = false;
                cityName = "Москва";
                pickupHeaderText = "Пункты самовывоза в Москве";
                deliveryInCityHeaderText = "Доставка по Москве";



                pickupData = {
                    0: {
                        id: "pickup-" + selectedValue + "-0",
                        siteId: "pickup.pickup_msk",
                        text: "ул. Брянская д. 32 с.6 (вход со стороны ул. Можайский Вал между д. 1 и д. 3)",
                        phoneNumber: "+7 (499) 647-7666",
                        workTime: "Пн-Пт: 09:00-21:00<br>Сб-Вск: 12:00-21:00",
                        typesOfPaymentText: "Наличными<br>Банковской картой",
                        card: true,
                        cash: true,
                        online: true
                    }
                };

                deliveryData = {
                    0: {
                        id: "delivery-" + selectedValue + "-0",
                        siteId: "delivery.moscowday",
                        text: "Москва \"день в день\" в пределах МКАД",
                        cost: "1000",
                        freeUntil: "15000",
                        paymentType: paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                    },
                    1: {
                        id: "delivery-" + selectedValue + "-1",
                        siteId: "delivery.moscowMKAD",
                        text: "Москва в пределах МКАД",
                        cost:  "300",
                        freeUntil:  "8000",
                        paymentType:  paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                        },
                    2: {
                        id: "delivery-" + selectedValue + "-2",
                        siteId: "delivery.moscowMKAD15",
                        text: "Москва в пределах 15км за МКАД",
                        cost: "700",
                        freeUntil: "15000",
                        paymentType: paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                    },
                    3: {
                        id: "delivery-" + selectedValue + "-3",
                        siteId: "delivery.moscowArea",
                        text: "Московская область",
                        cost: "1500",
                        freeUntil: "50000",
                        paymentType: paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                        }
                    };
                break;

                case "spb":
                    pickup = true;
                    deliveryInCity = true;
                    deliveryToRegions = false;
                    cityName = "Санкт-Петербург";


                    pickupHeaderText = "Пункты самовывоза в Санкт-Петербурге";
                    deliveryInCityHeaderText = "Доставка по Санкт-Петербургу";

                    pickupData = {
                        0: {
                            id: "pickup-" + selectedValue + "-0",
                            siteId : "pickup.pickup_spb",
                            text: "Ул. Будапештская, д. 11Б ТЦ Галерея",
                            phoneNumber: "+7 (812) 988-87-96",
                            workTime: "Пн-Сб 10:00-21:00 пятница - выходной",
                            typesOfPaymentText: "Наличными<br>Банковской картой",
                            card: true,
                            cash: true,
                            online: false
                        },
                        1: {
                            id: "pickup-" + selectedValue + "-1",
                            siteId: "pickup.pickup_spb_2",
                            text: "ул. Есенина, д. 5Б, ТК \"Ярус\"",
                            phoneNumber: "+7 (812) 988-87-97",
                            workTime: "Пн-Сб 10:00-21:00 среда - выходной",
                            typesOfPaymentText: "Наличными<br>Банковской картой",
                            card: true,
                            cash: true,
                            online: false
                        }
                    };

                    deliveryData = {
                        0: {
                            id: "delivery-" + selectedValue + "-0",
                            siteId: "delivery.spb",
                            text: cityName,
                            cost: "500",
                            freeUntil: "8000",
                            paymentType: paymentTypeTextForDelivery,
                            card: false,
                            cash: true,
                            online: false
                        }
                    };
                break;
                case "vrn":
                    pickup = true;
                    deliveryInCity = true;
                    deliveryToRegions = false;
                    cityName = "Воронеж";


                    pickupHeaderText = "Пункты самовывоза в Воронеже";
                    deliveryInCityHeaderText = "Доставка по Воронежу";

                    pickupData = {
                        0: {
                            id: "pickup-" + selectedValue + "-0",
                            siteId: "pickup.pickup_vrn",
                            text: "ул. 9-го Января, д. 280",
                            phoneNumber: "+7 (920) 225-3081",
                            workTime: "Пн-Пт 12:00-19:00<br>В выходные дни по предварительной договоренности.",
                            typesOfPaymentText: "Наличными",
                            card: false,
                            cash: true,
                            online: false
                        }
                    };

                    deliveryData = {
                        0: {
                            id: "delivery-" + selectedValue + "-0",
                            siteId: "delivery.vrn",
                            text: cityName,
                            cost: "400",
                            freeUntil: "8000",
                            paymentType: paymentTypeTextForDelivery,
                            card: false,
                            cash: true,
                            online: false
                        }
                    };

                break;
                case "tul":
                    pickup = true;
                    deliveryInCity = true;
                    deliveryToRegions = false;
                    cityName = "Тула";


                    pickupHeaderText = "Пункты самовывоза в Туле";
                    deliveryInCityHeaderText = "Доставка по Туле";

                    pickupData = {
                        0: {
                            id: "pickup-" + selectedValue + "-0",
                            siteId: "pickup.pickup_tula",
                            text: "ул. Рязанская, д. 52",
                            phoneNumber: "+7 (910) 582-7222",
                            workTime: "Пн-Вск 10:00-18:00",
                            typesOfPaymentText: "Наличными",
                            card: false,
                            cash: true,
                            online: false
                        }
                    };

                    deliveryData = {
                        0: {
                            id: "delivery-" + selectedValue + "-0",
                            siteId: "delivery.tula",
                            text: cityName,
                            cost: "300",
                            freeUntil: "5000",
                            paymentType: paymentTypeTextForDelivery,
                            card: false,
                            cash: true,
                            online: false
                        }
                    };
                break;
                case "other":
                    pickup = false;
                    deliveryInCity = false;
                    deliveryToRegions = true;
                    cityName = "";
                    var deliveryToRegionsHeaderText = "Доставка по России";

                    deliveryToRegionsData = {
                        0: {
                            id: "other-" + selectedValue + "-0",
                            siteId: "delivery.deliveryTK",
                            text: "Деловые линии",
                            cost: 0,
                            freeUntil: "-",
                            card: false,
                            cash: true,
                            online: true
                        },
                        1: {
                            id: "other-" + selectedValue + "-1",
                            siteId: "delivery.selectedTK",
                            text: "ATA",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        },
                        2: {
                            id: "other-" + selectedValue + "-2",
                            siteId: "delivery.selectedTK",
                            text: "Кит",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        },
                        3: {
                            id: "other-" + selectedValue + "-3",
                            siteId: "delivery.selectedTK",
                            text: "Почта России",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        },
                        4: {
                            id: "other-" + selectedValue + "-4",
                            siteId: "delivery.selectedTK",
                            text: "Другие",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        }
                    };

                break;
            }
            
            
            if(pickup){
                pickupContent += "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#checkout2PickupCollapse' aria-expanded='false' aria-controls='checkout2PickupCollapse'>"+ pickupHeaderText +"</a>";
                pickupContent += "<br><br>";
                pickupContent += "<div class='collapse shipping' id='checkout2PickupCollapse'>";
                pickupContent += initDeliveryContent(pickupData, "pickup");
                pickupContent += "</div>";
            }
                
            if(deliveryInCity){
                deliveryInCityContent += "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#checkout2DeliveryCollapse' aria-expanded='false' aria-controls='checkout2PickupCollapse'>"+ deliveryInCityHeaderText +"</a>";
                deliveryInCityContent += "<br><br>";
                deliveryInCityContent += "<div class='collapse shipping' id='checkout2DeliveryCollapse'>";
                deliveryInCityContent += initDeliveryContent(deliveryData, "delivery");
                deliveryInCityContent += "</div>";
            }
            
            if(deliveryToRegions){
                deliveryToRegionsContent += "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#checkout2DeliveryToRegionsCollapse' aria-expanded='false' aria-controls='checkout2PickupCollapse'>"+ deliveryToRegionsHeaderText +"</a>";
                deliveryToRegionsContent += "<br><br>";
                deliveryToRegionsContent += "<div class='collapse shipping' id='checkout2DeliveryToRegionsCollapse'>";
                deliveryToRegionsContent += initDeliveryContent(deliveryToRegionsData, "other");
                deliveryToRegionsContent += "</div>";
            }            
    }
    
    function htmlspecialchars(html) { 
      
      html = html.replace(/&/g, "&amp;"); 
      
      html = html.replace(/</g, "&lt;"); 
      html = html.replace(/>/g, "&gt;"); 
      html = html.replace(/"/g, "&quot;"); 
      
      return html; 
}
    
    var custNameInput = $("#checkout2CustomerFirstName"),
        custLastNameInput = $("#checkout2CustomerLastName"),
        custEmailInput = $("#checkout2CustomerEmail"),
        custPhoneInput = $("#checkout2CustomerPhone"),
        commentInput = $("#checkout2-payment-comment"),
        addressInput = $("#checkout2CustomerAddress"),
        citySelect = $("#checkout2CitySelect");
    
    $(document).ready(function(){
        
        var divPickupContent = $("#checkout2PickupContent");
        var divDeliveryContent = $("#checkout2DeliveryContent");
        var divDelToRegionsContent = $("#checkout2DeliveryToRegionsContent");
        var stepCounter = 0;
        
        var selectedCity = citySelect.attr("value");
        selectedCity = htmlspecialchars(selectedCity);
        if(selectedCity.length > 0){
            initAllDeliveryContent();
        }
        
        citySelect.change(function(){
        
            selectedValue = $("option:selected").attr("value");
            pickupContent = "";
            deliveryInCityContent = "";
            deliveryToRegionsContent = "";
            
            // формировать объекты динамически
            switch(selectedValue){
            case "msk":
                pickup = true;
                deliveryInCity = true;
                deliveryToRegions = false;
                cityName = "Москва";
                pickupHeaderText = "Пункты самовывоза в Москве";
                deliveryInCityHeaderText = "Доставка по Москве";



                pickupData = {
                    0: {
                        id: "pickup-" + selectedValue + "-0",
                        siteId: "pickup.pickup_msk",
                        text: "ул. Брянская д. 32 с.6 (вход со стороны ул. Можайский Вал между д. 1 и д. 3)",
                        phoneNumber: "+7 (499) 647-7666",
                        workTime: "Пн-Пт: 09:00-21:00<br>Сб-Вск: 12:00-21:00",
                        typesOfPaymentText: "Наличными<br>Банковской картой",
                        card: true,
                        cash: true,
                        online: true
                    }
                };

                deliveryData = {
                    0: {
                        id: "delivery-" + selectedValue + "-0",
                        siteId: "delivery.moscowday",
                        text: "Москва \"день в день\" в пределах МКАД",
                        cost: "1000",
                        freeUntil: "15000",
                        paymentType: paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                    },
                    1: {
                        id: "delivery-" + selectedValue + "-1",
                        siteId: "delivery.moscowMKAD",
                        text: "Москва в пределах МКАД",
                        cost:  "300",
                        freeUntil:  "8000",
                        paymentType:  paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                        },
                    2: {
                        id: "delivery-" + selectedValue + "-2",
                        siteId: "delivery.moscowMKAD15",
                        text: "Москва в пределах 15км за МКАД",
                        cost: "700",
                        freeUntil: "15000",
                        paymentType: paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                    },
                    3: {
                        id: "delivery-" + selectedValue + "-3",
                        siteId: "delivery.moscowArea",
                        text: "Московская область",
                        cost: "1500",
                        freeUntil: "50000",
                        paymentType: paymentTypeTextForDelivery,
                        card: false,
                        cash: true,
                        online: true
                        }
                    };
                break;

                case "spb":
                    pickup = true;
                    deliveryInCity = true;
                    deliveryToRegions = false;
                    cityName = "Санкт-Петербург";


                    pickupHeaderText = "Пункты самовывоза в Санкт-Петербурге";
                    deliveryInCityHeaderText = "Доставка по Санкт-Петербургу";

                    pickupData = {
                        0: {
                            id: "pickup-" + selectedValue + "-0",
                            siteId : "pickup.pickup_spb",
                            text: "Ул. Будапештская, д. 11Б ТЦ Галерея",
                            phoneNumber: "+7 (812) 988-87-96",
                            workTime: "Пн-Сб 10:00-21:00 пятница - выходной",
                            typesOfPaymentText: "Наличными<br>Банковской картой",
                            card: true,
                            cash: true,
                            online: false
                        },
                        1: {
                            id: "pickup-" + selectedValue + "-1",
                            siteId: "pickup.pickup_spb_2",
                            text: "ул. Есенина, д. 5Б, ТК \"Ярус\"",
                            phoneNumber: "+7 (812) 988-87-97",
                            workTime: "Пн-Сб 10:00-21:00 среда - выходной",
                            typesOfPaymentText: "Наличными<br>Банковской картой",
                            card: true,
                            cash: true,
                            online: false
                        }
                    };

                    deliveryData = {
                        0: {
                            id: "delivery-" + selectedValue + "-0",
                            siteId: "delivery.spb",
                            text: cityName,
                            cost: "500",
                            freeUntil: "8000",
                            paymentType: paymentTypeTextForDelivery,
                            card: false,
                            cash: true,
                            online: false
                        }
                    };
                break;
                case "vrn":
                    pickup = true;
                    deliveryInCity = true;
                    deliveryToRegions = false;
                    cityName = "Воронеж";


                    pickupHeaderText = "Пункты самовывоза в Воронеже";
                    deliveryInCityHeaderText = "Доставка по Воронежу";

                    pickupData = {
                        0: {
                            id: "pickup-" + selectedValue + "-0",
                            siteId: "pickup.pickup_vrn",
                            text: "ул. 9-го Января, д. 280",
                            phoneNumber: "+7 (920) 225-3081",
                            workTime: "Пн-Пт 12:00-19:00<br>В выходные дни по предварительной договоренности.",
                            typesOfPaymentText: "Наличными",
                            card: false,
                            cash: true,
                            online: false
                        }
                    };

                    deliveryData = {
                        0: {
                            id: "delivery-" + selectedValue + "-0",
                            siteId: "delivery.vrn",
                            text: cityName,
                            cost: "400",
                            freeUntil: "8000",
                            paymentType: paymentTypeTextForDelivery,
                            card: false,
                            cash: true,
                            online: false
                        }
                    };

                break;
                case "tul":
                    pickup = true;
                    deliveryInCity = true;
                    deliveryToRegions = false;
                    cityName = "Тула";


                    pickupHeaderText = "Пункты самовывоза в Туле";
                    deliveryInCityHeaderText = "Доставка по Туле";

                    pickupData = {
                        0: {
                            id: "pickup-" + selectedValue + "-0",
                            siteId: "pickup.pickup_tula",
                            text: "ул. Рязанская, д. 52",
                            phoneNumber: "+7 (910) 582-7222",
                            workTime: "Пн-Вск 10:00-18:00",
                            typesOfPaymentText: "Наличными",
                            card: false,
                            cash: true,
                            online: false
                        }
                    };

                    deliveryData = {
                        0: {
                            id: "delivery-" + selectedValue + "-0",
                            siteId: "delivery.tula",
                            text: cityName,
                            cost: "300",
                            freeUntil: "5000",
                            paymentType: paymentTypeTextForDelivery,
                            card: false,
                            cash: true,
                            online: false
                        }
                    };
                break;
                case "other":
                    pickup = false;
                    deliveryInCity = false;
                    deliveryToRegions = true;
                    cityName = "";
                    var deliveryToRegionsHeaderText = "Доставка по России";

                    deliveryToRegionsData = {
                        0: {
                            id: "other-" + selectedValue + "-0",
                            siteId: "delivery.deliveryTK",
                            text: "Деловые линии",
                            cost: 0,
                            freeUntil: "-",
                            card: false,
                            cash: true,
                            online: true
                        },
                        1: {
                            id: "other-" + selectedValue + "-1",
                            siteId: "delivery.selectedTK",
                            text: "ATA",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        },
                        2: {
                            id: "other-" + selectedValue + "-2",
                            siteId: "delivery.selectedTK",
                            text: "Кит",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        },
                        3: {
                            id: "other-" + selectedValue + "-3",
                            siteId: "delivery.selectedTK",
                            text: "Почта России",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        },
                        4: {
                            id: "other-" + selectedValue + "-4",
                            siteId: "delivery.selectedTK",
                            text: "Другие",
                            cost: "500",
                            freeUntil: "10000",
                            card: false,
                            cash: true,
                            online: true
                        }
                    };

                break;
            }
            
            
            if(pickup){
                pickupContent += "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#checkout2PickupCollapse' aria-expanded='false' aria-controls='checkout2PickupCollapse'>"+ pickupHeaderText +"</a>";
                pickupContent += "<br><br>";
                pickupContent += "<div class='collapse shipping' id='checkout2PickupCollapse'>";
                pickupContent += initDeliveryContent(pickupData, "pickup");
                pickupContent += "</div>";
            }
                
            if(deliveryInCity){
                deliveryInCityContent += "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#checkout2DeliveryCollapse' aria-expanded='false' aria-controls='checkout2PickupCollapse'>"+ deliveryInCityHeaderText +"</a>";
                deliveryInCityContent += "<br><br>";
                deliveryInCityContent += "<div class='collapse shipping' id='checkout2DeliveryCollapse'>";
                deliveryInCityContent += initDeliveryContent(deliveryData, "delivery");
                deliveryInCityContent += "</div>";
            }
            
            if(deliveryToRegions){
                deliveryToRegionsContent += "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#checkout2DeliveryToRegionsCollapse' aria-expanded='false' aria-controls='checkout2PickupCollapse'>"+ deliveryToRegionsHeaderText +"</a>";
                deliveryToRegionsContent += "<br><br>";
                deliveryToRegionsContent += "<div class='collapse shipping' id='checkout2DeliveryToRegionsCollapse'>";
                deliveryToRegionsContent += initDeliveryContent(deliveryToRegionsData, "other");
                deliveryToRegionsContent += "</div>";
            }            
            
        });
        
        //.checkout2_next
        $(".checkout2_next").click(function(){
            
            if(checkOutForm.valid()){
                
                var deliveryValue;
                var custName = custNameInput.attr("value"),
                    custLastName = custLastNameInput.attr("value"),
                    custEmail = custEmailInput.attr("value"),
                    custPhone = custPhoneInput.attr("value"),
                    comment = commentInput.attr("value"),
                    address = addressInput.attr("value");
                    
                
                
                allContent = "";
                allContent += "<h2>Информация по заказу</h2>";
                allContent += "<table class='table table-hover'>";
                allContent += "<tr> <th>Контактная информация</th> <th>Адрес</th> <th>Комментарий</th> <th>Способ получения</th> <th></th> </tr>";
                allContent += "<tr>";
                allContent += "<td> <p><b>Имя: </b>"+ custName +"</p> <p><b>Фамилия: </b>"+ custLastName +"</p> <p><b>Email: </b>"+ custEmail +"</p> <p><b>Телефон: </b>"+ custPhone +"</p> </td> <td> <p>"+ cityName +"</p> <p>"+ address +"</p></td> <td>"+ comment +"</td>";

                if(stepCounter === 0){
                    divPickupContent.html(pickupContent);
                    divDeliveryContent.html(deliveryInCityContent);
                    divDelToRegionsContent.html(deliveryToRegionsContent);
                    
                }
                if(stepCounter === 1){
                    
                    var deliveryRadioInput = $(".delivery_radio:radio:checked");
                    
                    if(deliveryRadioInput.prop("checked")){    
                        var deliveryAjaxValue = deliveryRadioInput.attr("value");
                        
                        urlDelVal = deliveryAjaxValue;
                        
                        checkout2BindShippingEvents(deliveryAjaxValue);
                        
                        deliveryValue = deliveryRadioInput.attr("id");
                        slickContainer.slick("slickNext");
                        stepCounter++;
                    }
                    else {
                        alert("Выберите способ доставки!");
                    }
                  
                }
                else{
                    slickContainer.slick("slickNext");
                    stepCounter++;
                }
                
                if(stepCounter === 2){
                                        
                    var elements = deliveryValue.split("-");
                    var objectName = elements[0];
                    var objectKey = elements[elements.length - 1];
                    var paymentConteiner = $("#checkout2PaymentConteiner");
                    var checked = "checked='checked'";
                    
                    
                    
                    paymentConteiner.html("");
                    paymentContent = "";
                    
                    paymentContent += "<table class='table table-hover'>";
                    
                    if(objectName === "pickup"){
                        if(pickupData[objectKey]["id"] === deliveryValue){
                           allContent += "<td>самовывоз</td>";
                            
                            if(pickupData[objectKey]["card"]){
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["card"]["siteId"], typesOfPaymentObject[objectName]["card"]["description"], checked);  
                            }
                            if(pickupData[objectKey]["cash"]){
                                if(pickupData[objectKey]["card"]){
                                    checked = "";
                                }
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["cash"]["siteId"], typesOfPaymentObject[objectName]["cash"]["description"], checked);
                            }
                            if(pickupData[objectKey]["online"]){
                                if(pickupData[objectKey]["card"] || pickupData[objectKey]["cash"]){
                                    checked = "";
                                }
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["online"]["siteId"], typesOfPaymentObject[objectName]["online"]["description"], checked);
                            }
                        }
                    }
                    else if(objectName === "delivery"){
                        if(deliveryData[objectKey]["id"] === deliveryValue){
                            allContent += "<td>доставка</td>";
                            
                            
                            
                            if(deliveryData[objectKey]["card"]){
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["card"]["siteId"], typesOfPaymentObject[objectName]["card"]["description"], checked);
                            }
                            if(deliveryData[objectKey]["cash"]){
                                if(deliveryData[objectKey]["card"]){
                                    checked = "";
                                }
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["cash"]["siteId"], typesOfPaymentObject[objectName]["cash"]["description"], checked);
                            }
                            if(deliveryData[objectKey]["online"]){
                                if(deliveryData[objectKey]["card"] || deliveryData[objectKey]["cash"]){
                                    checked = "";
                                }
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["online"]["siteId"], typesOfPaymentObject[objectName]["online"]["description"], checked);
                            }
                            
                        }
                    }
                    else if(objectName === "other"){
                        
                        
                        
                        if(deliveryToRegionsData[objectKey]["id"] === deliveryValue){
                            
                            allContent += "<td>доставка транспортной компанией</td>";
                            
                            objectName = "delivery";
                            if(deliveryToRegionsData[objectKey]["card"]){
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["card"]["siteId"], typesOfPaymentObject[objectName]["card"]["description"], checked);
                            }
                            if(deliveryToRegionsData[objectKey]["cash"]){
                                if(deliveryToRegionsData[objectKey]["card"]){
                                    checked = "";
                                }
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["cash"]["siteId"], typesOfPaymentObject[objectName]["cash"]["description"], checked);
                            }
                            if(deliveryToRegionsData[objectKey]["online"]){
                                if(deliveryToRegionsData[objectKey]["card"] || deliveryToRegionsData[objectKey]["cash"]){
                                    checked = "";
                                }
                                paymentContent += initPaymentContent(typesOfPaymentObject[objectName]["online"]["siteId"], typesOfPaymentObject[objectName]["online"]["description"], checked);
                            }
                            
                        }
                        
                    }
                    paymentContent += "</table>";
                    
                    allContent += "<td ><div id='checkout2CartTotalPrice' style='margin-left: -600px;'></div></td> </tr></table>";
                    
                    paymentConteiner.html(paymentContent + allContent);
                }
                
            }
        });

        $(".checkout2_prev").click(function(){
            if(stepCounter === 1){
                divPickupContent.html("");
                divDeliveryContent.html("");
                divDelToRegionsContent.html("");
            }
            stepCounter--;
            slickContainer.slick("slickPrev");
        });
        
        $('#checkout2-button-coupon').on('click', function() {
            
            var couponValue = $("#checkout2-input-coupon").attr("value");
            var orderForm = $("#checkout2Form");
            
            if(couponValue.length > 0){
            
                $.ajax({
                    url: 'index.php?route=checkout2/coupon/coupon',
                    type: 'get',
                    data: 'coupon=' + encodeURIComponent($('input[name=\'coupon\']').val()),
                    dataType: 'json',

                    beforeSend: function() {
                        $('#button-coupon').html('Загрузка...');
                    },
                    complete: function() {
                        $('#button-coupon').html('Сбросить');
                    },
                    error: function(json){

                        for(var key in json){
                            console.log("key: " + key + " value: " + json[key]);
                        }
                    },
                    success: function(json) {
                        $('.alert').remove();
                            if (json['error']) {
                                orderForm.before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                                $('html, body').animate({ scrollTop: 0 }, 'slow');
                            }
                            if (json['redirect']) {
                                location = json['redirect'];
                            }
                    }
                });
            }
            else{
                orderForm.before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Введите код купона <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        });
       
        checkOutForm.validate();
        
        
        checkOutForm.submit(function(){
            if( ( $(".payment_radio:radio:checked").prop("checked") ) && ( checkOutForm.valid() ) ){
                
                
                var paymentVal = $(".payment_radio:radio:checked").attr('value');
                
                //alert("firstname=" + custNameInput.attr('value') + "&lastname=" + custLastNameInput.attr('value') + "&email=" + custEmailInput.attr("value") + "&telephone=" +custPhoneInput.attr("value") + "&coupon=" + $('#checkout2-input-coupon').attr('value') + "&city=" + $('#checkout2CitySelect').attr('value') + "&address_1=" + addressInput.attr("value") + "&comment=" + commentInput.attr("value") + "&shipping_method=" + urlDelVal + "&payMethod=" + paymentVal);
                
                $.ajax({
                    url: '?route=checkout2/checkout2/createOrder',
                    type: 'post',
                    data: "ajax=true&firstname=" + custNameInput.attr('value') + "&lastname=" + custLastNameInput.attr('value') + "&email=" + custEmailInput.attr("value") + "&telephone=" +custPhoneInput.attr("value") + "&coupon=" + $('#checkout2-input-coupon').attr('value') + "&city=" + $('#checkout2CitySelect').attr('value') + "&address_1=" + addressInput.attr("value") + "&comment=" + commentInput.attr("value") + "&shipping_method=" + urlDelVal + "&payMethod=" + paymentVal,
                    dataType: 'json',

                    error: function(json){

                        for(var key in json){
                            console.log("key: " + key + " value: " + json[key]);
                        }
                        alert("error");
                    },
                    success: function(json) {
                        
                        
                        for(var key in json){
                            
                            if(key === "redirect"){
                                document.location.href = json[key];
                            }
                            //console.log("key: " + key + " value: " + json[key]);
                            
                        }
                    }
                });
                
                
                
            }
            else{
                alert("Выберите способ оплаты!");
                return false;
            }
        });
        
        
        
       
       
    });


