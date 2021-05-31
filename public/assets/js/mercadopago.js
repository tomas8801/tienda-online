
export default function checkOut() {

    const d = document,
    $form_pedido = d.getElementById('formPedido');

    
    // const getPreference = async (e) => {
    //     e.preventDefault();


        

      
    //         // try {
    //         //     let options = {
    //         //         method: "GET",
    //         //         headers: {
    //         //             "Accept": "application/json"
    //         //         }
    //         //     }
    //         //     let res = await fetch('http://localhost/tienda-online/pago/pagar', options);
    //         //     let data = await res.json();
    //         //     console.log(res, data);
    //         //     if(!res.ok) throw { status: res.status, statusText: res.statusText };

    //         // }catch(err) {
    //         //     let message = err.statusText || "Ocurrió un error";
    //         //     console.log(message)
    //         // }
            
    //     // console.log(json);
    //     // createCheckoutButton(json)

    // };
    // d.addEventListener('click', async function(e) {
    //     e.preventDefault();

    //     if(e.target.id == 'button-checkout') {
    //         try {
               
    //             let options = {
    //                 method: "GET",
    //                 headers: {
    //                     "Content-type": "application/json; charset=utf-8"
    //                 }
    //             }
                
    //             let res = await fetch('http://localhost/tienda-online/pago/pagar', options);
    //             let json = await res.json();
    //             console.log(json)

    //             if(!res.ok) throw { status: res.status, statusText: res.statusText };

    //         } catch (err) {
    //             let message = err.statusText || "Ocurrió un error";
    //             console.log(message)
    //         }
    //     }
    // })

    // console.log('caca');
    
    //  const getPreference = async () => {
    //      let res = await fetch('http:localhost/tienda-online/pago/pagar');
    //      let json = await res.json();
    //       if(!res.ok) throw { status: res.status, statusText: res.statusText };
    //       console.log(json);
    //     createCheckoutButton(json)
        
      
    //  }
    
      
      const createCheckoutButton = (preference) => {
         var script = document.createElement("script");
  
         //  The source domain must be completed according to the site for which you are integrating.
          // For example: for Argentina ".com.ar" or for Brazil ".com.br".
          script.src = "https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js";
        script.type = "text/javascript";
         script.dataset.preferenceId = preference;
         document.getElementById("button-checkout").innerHTML = "";
         document.querySelector("#button-checkout").appendChild(script);
      }

    
}