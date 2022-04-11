 class Notification {
    success(){
     new Noty({
         type: 'success',
         layout: 'topRight',
         text: 'Effectué avec succès',
         timeout: 2000,
     }).show();
    }

     alert(){
         new Noty({
             type: 'alert',
             layout: 'topRight',
             text: 'Etes vous sure',
             timeout: 2000,
         }).show();
     }

     error(){
         new Noty({
             type: 'alert',
             layout: 'topRight',
             text: 'Error !!!',
             timeout: 2000,
         }).show();
     }

     warning(){
         new Noty({
             type: 'warning',
             layout: 'topRight',
             text: 'Attention !!!',
             timeout: 2000,
         }).show();
     }
 }

 export default Notification = new Notification()
