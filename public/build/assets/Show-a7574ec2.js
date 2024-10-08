import{_ as M}from"./AppLayout-af5e8264.js";import{_ as A}from"./PrimaryButton-3ed0f677.js";import{_ as E,i as T,k as D,I as x,o as u,c as g,w as c,a as e,t as n,b as o,f,e as p,g as b,F as v,D as z,$ as P,n as S,h as O}from"./app-024b1c19.js";import{u as V,r as L,a as y}from"./i18n-validators-d6bc6beb.js";import{_ as $}from"./SecondaryButton-ae2da2c3.js";import{a as F}from"./DialogModal-9d70fdc7.js";import{_ as j}from"./InputLabel-3dcfe30a.js";import{_ as I}from"./DangerButton-23b0ea65.js";const N={components:{DangerButton:I,InputLabel:j,DialogModal:F,SecondaryButton:$,FontAwesomeIcon:T,PrimaryButton:A,AppLayout:M,Link:D},setup(){return{v$:V()}},props:{design_request:Object,priorities:Array,time_states:Array,states:Array,designers:Array,customers:Array,psl_customers:Array,sellers:Array},validations(){return{taskModal:{form:{id:{requiredIf:L(this.taskModal.editMode)},design_request_id:{required:y},description:{required:y}}}}},data(){return{designRequest:this.design_request,taskModal:{open:!1,editMode:!1,form:{id:"",design_request_id:this.design_request.id,description:""}}}},methods:{storeTask(s){this.v$.taskModal.form.$touch(),this.v$.taskModal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.post(route("task.store"),s).then(t=>{this.closeModal(),this.designRequest.tasks=t.data}).catch(t=>{this.$swal({icon:"error",title:"Error",text:t.response.data.message})})},editTask(s){this.taskModal={open:!0,editMode:!0,form:{id:s.id,design_request_id:this.design_request.id,description:s.description}}},updateTask(s){this.v$.taskModal.form.$touch(),this.v$.taskModal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.put(route("task.update",s.id),s).then(t=>{this.closeModal(),this.designRequest.tasks=t.data}).catch(t=>{this.$swal({icon:"error",title:"Error",text:t.response.data.message})})},destroyTask(s,t){this.$swal({icon:"question",title:"¿Eliminar registro?",text:"¡Esta acción no es reversible!",showCancelButton:!0,confirmButtonText:"¡Si, Eliminar!"}).then(i=>{i.isConfirmed&&axios.delete(route("task.destroy",[s,t])).then(m=>{this.designRequest.tasks=m.data}).catch(m=>{this.$swal({icon:"error",title:"Error",text:m.response.data.message})})})},openModal(){this.taskModal={open:!0,editMode:!1,form:{id:"",design_request_id:this.design_request.id,description:""}}},closeModal(){this.taskModal={open:!1,editMode:!1,form:{id:"",design_request_id:this.design_request.id,description:""}},this.v$.taskModal.form.$reset()},updateState(){let s=this.states.map(t=>[t.id,t.name]);s=Object.fromEntries(s),this.$swal({icon:"info",title:"Estado",text:"Por favor, seleccione una opción",input:"select",inputOptions:s,inputValue:this.designRequest.state.id,showCancelButton:!0,inputAttributes:{required:!0},customClass:{input:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "},confirmButtonText:"Actualizar",cancelButtonText:"Cancelar",inputValidator:t=>{if(t==="0")return"Debes seleccionar una opción..."}}).then(t=>{t.value&&axios.post(route("design.request.update-state"),{id:this.designRequest.id,property:"state_id",state_id:t.value}).then(i=>{this.designRequest=i.data,this.$swal({icon:"success",title:"¡Registro actualizado!",text:"Estado actualizado con éxito",toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,reverseButtons:!1})}).catch(i=>{this.$swal({icon:"error",title:"Error",text:i.response.data.message})})})},updateTimeState(){let s=this.time_states.map(t=>[t.id,t.name]);s=Object.fromEntries(s),this.$swal({icon:"info",title:"Estado de tiempo",text:"Por favor, seleccione una opción",input:"select",inputOptions:s,inputValue:this.designRequest.time_state.id,showCancelButton:!0,inputAttributes:{required:!0},customClass:{input:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "},confirmButtonText:"Actualizar",cancelButtonText:"Cancelar",inputValidator:t=>{if(t==="0")return"Debes seleccionar una opción..."}}).then(t=>{t.value&&axios.post(route("design.request.update-state"),{id:this.designRequest.id,property:"time_state_id",state_id:t.value}).then(i=>{this.designRequest=i.data,this.$swal({icon:"success",title:"¡Registro actualizado!",text:"Estado de tiempo actualizado con éxito",toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,reverseButtons:!1})}).catch(i=>{this.$swal({icon:"error",title:"Error",text:i.response.data.message})})})},updatePriority(){let s=this.priorities.map(t=>[t.id,t.name]);s=Object.fromEntries(s),this.$swal({icon:"info",title:"Prioridad",text:"Por favor, seleccione una opción",input:"select",inputOptions:s,inputValue:this.designRequest.priority.id,showCancelButton:!0,inputAttributes:{required:!0},customClass:{input:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "},confirmButtonText:"Actualizar",cancelButtonText:"Cancelar",inputValidator:t=>{if(t==="0")return"Debes seleccionar una opción..."}}).then(t=>{t.value&&axios.post(route("design.request.update-state"),{id:this.designRequest.id,property:"priority_id",state_id:t.value}).then(i=>{this.designRequest=i.data,this.$swal({icon:"success",title:"¡Registro actualizado!",text:"Prioridad actualizada con éxito",toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,reverseButtons:!1})}).catch(i=>{this.$swal({icon:"error",title:"Error",text:i.response.data.message})})})},updateDesigner(){let s=this.designers.map(t=>[t.id,t.name]);s=Object.fromEntries(s),this.$swal({icon:"info",title:"Diseñador(a)",text:"Por favor, seleccione una opción",input:"select",inputOptions:s,inputValue:this.designRequest.designer.id,showCancelButton:!0,inputAttributes:{required:!0},customClass:{input:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "},confirmButtonText:"Actualizar",cancelButtonText:"Cancelar",inputValidator:t=>{if(t==="0")return"Debes seleccionar una opción..."}}).then(t=>{t.value&&axios.post(route("design.request.update-state"),{id:this.designRequest.id,property:"designer_id",state_id:t.value}).then(i=>{this.designRequest=i.data,this.$swal({icon:"success",title:"¡Registro actualizado!",text:"Diseñador actualizado con éxito",toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,reverseButtons:!1})}).catch(i=>{this.$swal({icon:"error",title:"Error",text:i.response.data.message})})})},updateSeller(){let s=this.sellers.map(t=>[t.id,t.name]);s=Object.fromEntries(s),this.$swal({icon:"info",title:"Diseñador(a)",text:"Por favor, seleccione una opción",input:"select",inputOptions:s,inputValue:this.designRequest.seller.id,showCancelButton:!0,inputAttributes:{required:!0},customClass:{input:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "},confirmButtonText:"Actualizar",cancelButtonText:"Cancelar",inputValidator:t=>{if(t==="0")return"Debes seleccionar una opción..."}}).then(t=>{t.value&&axios.post(route("design.request.update-state"),{id:this.designRequest.id,property:"seller_id",state_id:t.value}).then(i=>{this.designRequest=i.data,this.$swal({icon:"success",title:"¡Registro actualizado!",text:"Vendedor actualizado con éxito",toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,reverseButtons:!1})}).catch(i=>{this.$swal({icon:"error",title:"Error",text:i.response.data.message})})})},updateCustomer(){let s=this.customers.map(t=>[t.id,t.name]);s=Object.fromEntries(s),this.$swal({icon:"info",title:"Diseñador(a)",text:"Por favor, seleccione una opción",input:"select",inputOptions:s,inputValue:this.designRequest.customer.id,showCancelButton:!0,inputAttributes:{required:!0},customClass:{input:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "},confirmButtonText:"Actualizar",cancelButtonText:"Cancelar",inputValidator:t=>{if(t==="0")return"Debes seleccionar una opción..."}}).then(t=>{t.value&&axios.post(route("design.request.update-state"),{id:this.designRequest.id,property:"customer_id",state_id:t.value}).then(i=>{this.designRequest=i.data,this.$swal({icon:"success",title:"¡Registro actualizado!",text:"Cliente actualizado con éxito",toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,reverseButtons:!1})}).catch(i=>{this.$swal({icon:"error",title:"Error",text:i.response.data.message})})})}}},G={class:"flex flex-row"},U={class:"font-semibold text-xl text-gray-800 leading-tight"},H={class:"py-12"},J={class:"max-w-8xl mx-6 sm:px-6 lg:px-8"},K={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},Q={class:"py-2 align-middle inline-block min-w-full"},W={class:"grid grid-cols-6 gap-5"},X={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},Y={class:"flex-auto p-4"},Z={class:"flex flex-wrap -mx-3"},ee={class:"flex-none w-2/3 max-w-full px-3"},te=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Prioridad ",-1),se={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},oe={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},ie={class:"flex-auto p-4"},ae={class:"flex flex-wrap -mx-3"},le={class:"flex-none w-2/3 max-w-full px-3"},ne=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Diseñador ",-1),re={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},de={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},ce={class:"flex-auto p-4"},ue={class:"flex flex-wrap -mx-3"},xe={class:"flex-none w-2/3 max-w-full px-3"},me=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Vendedor(a) ",-1),fe={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},pe={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},_e={class:"flex-auto p-4"},he={class:"flex flex-wrap -mx-3"},ge={class:"flex-none w-2/3 max-w-full px-3"},we=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Cliente ",-1),be={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},ve={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},ye={class:"flex-auto p-4"},ke={class:"flex flex-wrap -mx-3"},qe={class:"flex-none w-2/3 max-w-full px-3"},Ce=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Fecha recepción ",-1),Re={class:"mb-0 font-bold"},Be={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},Me={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},Ae={class:"flex-auto p-4"},Ee={class:"flex flex-wrap -mx-3"},Te={class:"flex-none w-2/3 max-w-full px-3"},De=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Fecha tentativa ",-1),ze={class:"mb-0 font-bold"},Pe={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},Se={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},Oe={class:"flex-auto p-4"},Ve={class:"flex flex-wrap -mx-3"},Le={class:"flex-none w-2/3 max-w-full px-3"},$e=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Fecha real ",-1),Fe={class:"mb-0 font-bold"},je={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},Ie={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},Ne={class:"flex-auto p-4"},Ge={class:"flex flex-wrap -mx-3"},Ue={class:"flex-none w-2/3 max-w-full px-3"},He=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Fecha entrega ",-1),Je={class:"mb-0 font-bold"},Ke={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},Qe={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},We={class:"flex-auto p-4"},Xe={class:"flex flex-wrap -mx-3"},Ye={class:"flex-none w-2/3 max-w-full px-3"},Ze=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Fecha aprobación cliente ",-1),et={class:"mb-0 font-bold"},tt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},st={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},ot={class:"flex-auto p-4"},it={class:"flex flex-wrap -mx-3"},at={class:"flex-none w-2/3 max-w-full px-3"},lt=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Fecha sherpa ",-1),nt={class:"mb-0 font-bold"},rt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},dt={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},ct={class:"flex-auto p-4"},ut={class:"flex flex-wrap -mx-3"},xt={class:"flex-none w-2/3 max-w-full px-3"},mt=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Estado de tiempo ",-1),ft={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},pt={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},_t={class:"flex-auto p-4"},ht={class:"flex flex-wrap -mx-3"},gt={class:"flex-none w-2/3 max-w-full px-3"},wt=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Estado ",-1),bt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},vt={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},yt={class:"flex-auto p-4"},kt={class:"flex flex-wrap -mx-3"},qt={class:"flex-none w-2/3 max-w-full px-3"},Ct=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Creado por ",-1),Rt={class:"mb-0 font-bold"},Bt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},Mt={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"},At={class:"flex-auto p-4"},Et={class:"flex flex-wrap -mx-3"},Tt={class:"flex-none w-2/3 max-w-full px-3"},Dt=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Actualizado por ",-1),zt={class:"mb-0 font-bold"},Pt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},St={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border col-span-2"},Ot={class:"flex-auto p-4"},Vt={class:"flex flex-wrap -mx-3"},Lt={class:"flex-none w-2/3 max-w-full px-3"},$t=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Observaciones ",-1),Ft={class:"mb-0 font-bold"},jt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},It={class:"relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border col-span-2"},Nt={class:"flex-auto p-4"},Gt={class:"flex flex-wrap -mx-3"},Ut={class:"flex-none w-2/3 max-w-full px-3"},Ht=e("p",{class:"mb-0 font-sans font-semibold leading-normal text-sm"}," Comentarios ",-1),Jt={class:"mb-0 font-bold"},Kt={class:"w-4/12 max-w-full px-3 ml-auto text-right flex-0"},Qt={class:"max-w-8xl mx-6 sm:px-6 lg:px-8"},Wt={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},Xt={class:"py-2 align-middle inline-block min-w-full"},Yt={class:"shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"},Zt={class:"min-w-full divide-y divide-gray-200"},es={class:"bg-gray-50"},ts={class:"border-b"},ss=e("th",{colspan:"5",scope:"col",class:"px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"}," TAREAS ",-1),os={scope:"col",class:"px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider"},is=e("tr",null,[e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Descripción "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Creado por "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Creado el "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Actualizado por "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Actualizado el "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"})],-1),as={class:"bg-white divide-y divide-gray-200"},ls={class:"px-6 py-4 text-left text-sm font-medium"},ns={class:"px-6 py-4 text-left text-sm font-medium"},rs={class:"px-6 py-4 text-left text-sm font-medium"},ds={class:"px-6 py-4 text-left text-sm font-medium"},cs={class:"px-6 py-4 text-left text-sm font-medium"},us={class:"px-6 py-4 text-center text-sm font-medium"},xs={class:"flex flex-row"},ms={key:1},fs=e("td",{class:"px-6 py-4 text-center text-red-500 text-sm font-medium",colspan:"6"}," Sin registros… ",-1),ps=[fs],_s={key:0,class:"mt-1"};function hs(s,t,i,m,a,d){const r=x("font-awesome-icon"),k=x("Link"),_=x("PrimaryButton"),w=x("SecondaryButton"),q=x("DangerButton"),C=x("InputLabel"),R=x("DialogModal"),B=x("AppLayout");return u(),g(B,{title:`Diseño - Solicitud # ${a.designRequest.id}`},{header:c(()=>[e("div",G,[e("h2",U," Diseño - Solicitud # "+n(a.designRequest.id),1)])]),actions:c(()=>[o(k,{href:s.route("request.index"),class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-auto"},{default:c(()=>[o(r,{icon:"arrow-left",class:"mr-2"}),f(" Atrás ")]),_:1},8,["href"])]),default:c(()=>[e("div",H,[e("div",J,[e("div",K,[e("div",Q,[e("div",W,[e("div",X,[e("div",Y,[e("div",Z,[e("div",ee,[e("div",null,[te,e("h5",{class:"mb-0 font-bold hover:text-blue-800 cursor-pointer",onClick:t[0]||(t[0]=(...l)=>d.updatePriority&&d.updatePriority(...l))},n(a.designRequest.priority.name),1)])]),e("div",se,[o(r,{icon:"turn-up",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",oe,[e("div",ie,[e("div",ae,[e("div",le,[e("div",null,[ne,e("h5",{class:"mb-0 font-bold hover:text-blue-800 cursor-pointer",onClick:t[1]||(t[1]=(...l)=>d.updateDesigner&&d.updateDesigner(...l))},n(a.designRequest.designer.name),1)])]),e("div",re,[o(r,{icon:"user",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",de,[e("div",ce,[e("div",ue,[e("div",xe,[e("div",null,[me,e("h5",{class:"mb-0 font-bold hover:text-blue-800 cursor-pointer",onClick:t[2]||(t[2]=(...l)=>d.updateSeller&&d.updateSeller(...l))},n(a.designRequest.seller.name),1)])]),e("div",fe,[o(r,{icon:"user",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",pe,[e("div",_e,[e("div",he,[e("div",ge,[e("div",null,[we,e("h5",{class:"mb-0 font-bold hover:text-blue-800 cursor-pointer",onClick:t[3]||(t[3]=(...l)=>d.updateCustomer&&d.updateCustomer(...l))},n(a.designRequest.customer.name),1)])]),e("div",be,[o(r,{icon:"user",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",ve,[e("div",ye,[e("div",ke,[e("div",qe,[e("div",null,[Ce,e("h5",Re,n(a.designRequest.reception_date),1)])]),e("div",Be,[o(r,{icon:"calendar",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",Me,[e("div",Ae,[e("div",Ee,[e("div",Te,[e("div",null,[De,e("h5",ze,n(a.designRequest.tentative_date),1)])]),e("div",Pe,[o(r,{icon:"calendar",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",Se,[e("div",Oe,[e("div",Ve,[e("div",Le,[e("div",null,[$e,e("h5",Fe,n(a.designRequest.real_date),1)])]),e("div",je,[o(r,{icon:"calendar",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",Ie,[e("div",Ne,[e("div",Ge,[e("div",Ue,[e("div",null,[He,e("h5",Je,n(a.designRequest.delivery_date),1)])]),e("div",Ke,[o(r,{icon:"calendar",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",Qe,[e("div",We,[e("div",Xe,[e("div",Ye,[e("div",null,[Ze,e("h5",et,n(a.designRequest.customer_approved_date),1)])]),e("div",tt,[o(r,{icon:"calendar",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",st,[e("div",ot,[e("div",it,[e("div",at,[e("div",null,[lt,e("h5",nt,n(a.designRequest.estimated_arrival_sherpa_date),1)])]),e("div",rt,[o(r,{icon:"calendar",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",dt,[e("div",ct,[e("div",ut,[e("div",xt,[e("div",null,[mt,e("h5",{class:"mb-0 font-bold hover:text-blue-800 cursor-pointer",onClick:t[4]||(t[4]=(...l)=>d.updateTimeState&&d.updateTimeState(...l))},n(a.designRequest.time_state.name),1)])]),e("div",ft,[o(r,{icon:"clock",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",pt,[e("div",_t,[e("div",ht,[e("div",gt,[e("div",null,[wt,e("h5",{class:"mb-0 font-bold hover:text-blue-800 cursor-pointer",onClick:t[5]||(t[5]=(...l)=>d.updateState&&d.updateState(...l))},n(a.designRequest.state.name),1)])]),e("div",bt,[o(r,{icon:"circle-check",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",vt,[e("div",yt,[e("div",kt,[e("div",qt,[e("div",null,[Ct,e("h5",Rt,n(a.designRequest.created_by.name),1)])]),e("div",Bt,[o(r,{icon:"user",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",Mt,[e("div",At,[e("div",Et,[e("div",Tt,[e("div",null,[Dt,e("h5",zt,n(a.designRequest.updated_by.name),1)])]),e("div",Pt,[o(r,{icon:"user",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",St,[e("div",Ot,[e("div",Vt,[e("div",Lt,[e("div",null,[$t,e("h5",Ft,n(a.designRequest.observations),1)])]),e("div",jt,[o(r,{icon:"comments",class:"text-3xl relative top-2.5 text-gray-900"})])])])]),e("div",It,[e("div",Nt,[e("div",Gt,[e("div",Ut,[e("div",null,[Ht,e("h5",Jt,n(a.designRequest.comments),1)])]),e("div",Kt,[o(r,{icon:"comments",class:"text-3xl relative top-2.5 text-gray-900"})])])])])])])])]),e("div",Qt,[e("div",Wt,[e("div",Xt,[e("div",Yt,[e("table",Zt,[e("thead",es,[e("tr",ts,[ss,e("th",os,[o(_,{onClick:d.openModal},{default:c(()=>[o(r,{icon:"plus",class:"mr-2"}),f(" Agregar ")]),_:1},8,["onClick"])])]),is]),e("tbody",as,[a.designRequest.tasks.length>0?(u(!0),p(v,{key:0},b(a.designRequest.tasks,l=>(u(),p("tr",null,[e("td",ls,n(l.description),1),e("td",ns,n(l.created_by.name),1),e("td",rs,n(l.created_at),1),e("td",ds,n(l.updated_by.name),1),e("td",cs,n(l.updated_at),1),e("td",us,[e("div",xs,[o(w,{class:"mr-2",onClick:h=>d.editTask(l)},{default:c(()=>[o(r,{icon:["far","pen-to-square"]})]),_:2},1032,["onClick"]),o(q,{onClick:h=>d.destroyTask(l.design_request_id,l.id)},{default:c(()=>[o(r,{icon:["far","trash-can"]})]),_:2},1032,["onClick"])])])]))),256)):(u(),p("tr",ms,ps))])])])])])])]),o(R,{show:a.taskModal.open,onClose:d.closeModal,"max-width":"2xl"},{title:c(()=>[f(" Tarea ")]),content:c(()=>[e("div",null,[o(C,{value:"Descripción"}),z(e("textarea",{class:S(["border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full resize-none",{"border-red-500":m.v$.taskModal.form.description.$error}]),"onUpdate:modelValue":t[6]||(t[6]=l=>a.taskModal.form.description=l),required:"",cols:"30",rows:"2"},null,2),[[P,a.taskModal.form.description]]),m.v$.taskModal.form.description.$error?(u(),p("ul",_s,[(u(!0),p(v,null,b(m.v$.taskModal.form.description.$errors,(l,h)=>(u(),p("li",{class:"text-red-500",key:h},n(l.$message),1))),128))])):O("",!0)])]),footer:c(()=>[o(w,{onClick:d.closeModal},{default:c(()=>[f(" Cancelar ")]),_:1},8,["onClick"]),a.taskModal.editMode?(u(),g(_,{key:0,class:"ml-3",onClick:t[7]||(t[7]=l=>d.updateTask(a.taskModal.form))},{default:c(()=>[f(" Actualizar ")]),_:1})):(u(),g(_,{key:1,class:"ml-3",onClick:t[8]||(t[8]=l=>d.storeTask(a.taskModal.form))},{default:c(()=>[f(" Guardar ")]),_:1}))]),_:1},8,["show","onClose"])]),_:1},8,["title"])}const Rs=E(N,[["render",hs]]);export{Rs as default};
