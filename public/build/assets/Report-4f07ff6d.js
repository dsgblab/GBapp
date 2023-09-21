import{_ as E}from"./AppLayout-8fe3f272.js";import{_ as I}from"./PrimaryButton-6b407ce1.js";import{_ as N}from"./DangerButton-e1127d4a.js";import{_ as A}from"./InputLabel-6da3f361.js";import{a as S}from"./DialogModal-ee4749fc.js";import{_ as T}from"./Checkbox-fe648b67.js";import{_ as U}from"./SecondaryButton-e98c9091.js";import{_ as z}from"./TextInput-3032170e.js";import{u as G,r as O,a as b}from"./i18n-validators-e56c5a18.js";import{k as P,I as c,L as F,o,c as p,w as d,a as e,D as B,b as s,g as f,e as a,h,F as x,t as _,n as w,f as $}from"./app-826d0887.js";import{_ as j}from"./CustomButton-4583b0df.js";import{_ as H}from"./_plugin-vue_export-helper-c27b6911.js";const J={setup(){return{v$:G()}},props:{reports:Array},components:{CustomButton:j,TextInput:z,SecondaryButton:U,Checkbox:T,DialogModal:S,InputLabel:A,DangerButton:N,PrimaryButton:I,AppLayout:E,Link:P},validations(){return{modal:{form:{id:{requiredIf:O(this.modal.editMode)},name:{required:b},group_id:{required:b},report_id:{required:b},dataset_id:{required:b}}}}},data(){return{records:this.reports,modal:{title:"",editMode:!1,open:!1,form:{id:"",name:"",group_id:"",report_id:"",dataset_id:""}}}},methods:{create(){this.modal.open=!0,this.modal.title="Agregar reporte"},edit(r){this.modal={title:"Editar reporte",editMode:!0,open:!0,form:{id:r.id,name:r.name,group_id:r.group_id,report_id:r.report_id,dataset_id:r.dataset_id}}},store(){this.v$.modal.form.$touch(),this.v$.modal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.post(route("report.store"),this.modal.form).then(r=>{this.closeModal(),this.records=r.data}).catch(r=>{this.$swal({icon:"error",title:"ERROR",text:r.response.data})})},update(){this.v$.modal.form.$touch(),this.v$.modal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.put(route("report.update",this.modal.form.id),this.modal.form).then(r=>{this.closeModal(),this.records=r.data}).catch(r=>{this.$swal({icon:"error",title:"Error",text:r.response.data})})},destroy(r){this.$swal({icon:"question",title:"¿Eliminar reporte?",text:"¡Esta acción no es reversible!",showCancelButton:!0,confirmButtonText:"¡Si, Eliminar!"}).then(n=>{n.isConfirmed&&axios.delete(route("report.destroy",r)).then(g=>{this.records=g.data}).catch(g=>{this.$swal({icon:"error",title:"Error",text:g.response.data})})})},closeModal(){this.modal={title:"",editMode:!1,open:!1,form:{id:"",name:"",group_id:"",report_id:"",dataset_id:""}},this.v$.modal.form.$reset()}}},K={class:"flex flex-row"},Q=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Reportes ",-1),W={class:"py-12"},X={class:"max-w-8xl mx-6 sm:px-6 lg:px-8"},Y={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},Z={class:"py-2 align-middle inline-block min-w-full"},ee={class:"shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"},te={class:"min-w-full divide-y divide-gray-200"},oe=e("thead",{class:"bg-gray-50"},[e("tr",null,[e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Nombre "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Ultima actualización ")])],-1),re={class:"bg-white divide-y divide-gray-200"},se={class:"px-6 py-4 text-center text-sm font-medium"},ae={class:"flex flex-row"},ie={class:"px-6 py-4 text-left text-sm font-medium"},le={class:"px-6 py-4 text-left text-sm font-medium"},de={key:1},ne=e("td",{colspan:"9",class:"px-6 py-4 text-center text-sm font-medium text-red-500"}," No se encontraron registros… ",-1),me=[ne],ce={class:"mt-4"},ue={key:0,class:"mt-1"},_e={class:"mt-4"},pe={key:0,class:"mt-1"},fe={class:"mt-4"},he={key:0,class:"mt-1"},xe={class:"mt-4"},ge={key:0,class:"mt-1"};function ye(r,n,g,l,i,u){const y=c("font-awesome-icon"),C=c("PrimaryButton"),R=c("Link"),M=c("CustomButton"),v=c("InputLabel"),k=c("TextInput"),q=c("SecondaryButton"),L=c("DialogModal"),D=c("AppLayout"),V=F("permission");return o(),p(D,{title:"Reportes"},{header:d(()=>[e("div",K,[Q,B((o(),p(C,{type:"button",class:"ml-auto",onClick:u.create},{default:d(()=>[s(y,{icon:"plus",class:"mr-2"}),f(" Crear ")]),_:1},8,["onClick"])),[[V,"report.create"]])])]),default:d(()=>[e("div",W,[e("div",X,[e("div",Y,[e("div",Z,[e("div",ee,[e("table",te,[oe,e("tbody",re,[i.records.length>0?(o(!0),a(x,{key:0},h(i.records,t=>(o(),a("tr",null,[e("td",se,[e("div",ae,[s(R,{href:r.route("report.view",[t.group_id,t.report_id]),class:"mr-2 inline-flex items-center px-2 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"},{default:d(()=>[s(y,{icon:["fas","arrow-up-right-from-square"]})]),_:2},1032,["href"]),B((o(),p(M,{class:"mr-2",onClick:m=>u.edit(t)},{default:d(()=>[s(y,{icon:["far","pen-to-square"]})]),_:2},1032,["onClick"])),[[V,"report.edit"]]),B((o(),p(M,{onClick:m=>u.destroy(t.id)},{default:d(()=>[s(y,{icon:["far","trash-can"]})]),_:2},1032,["onClick"])),[[V,"report.destroy"]])])]),e("td",ie,_(t.name),1),e("td",le,_(t.updated_at),1)]))),256)):(o(),a("tr",de,me))])])])])])])]),s(L,{show:i.modal.open,onClose:u.closeModal},{title:d(()=>[f(_(i.modal.title),1)]),content:d(()=>[e("div",ce,[s(v,{value:"Nombre"}),s(k,{modelValue:i.modal.form.name,"onUpdate:modelValue":n[0]||(n[0]=t=>i.modal.form.name=t),type:"text",class:w(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.name.$error}]),required:"",autocomplete:"Nombre"},null,8,["modelValue","class"]),l.v$.modal.form.name.$error?(o(),a("ul",ue,[(o(!0),a(x,null,h(l.v$.modal.form.name.$errors,(t,m)=>(o(),a("li",{class:"text-red-500",key:m},_(t.$message),1))),128))])):$("",!0)]),e("div",_e,[s(v,{value:"Grupo"}),s(k,{modelValue:i.modal.form.group_id,"onUpdate:modelValue":n[1]||(n[1]=t=>i.modal.form.group_id=t),type:"text",class:w(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.group_id.$error}]),required:"",autocomplete:"Grupo"},null,8,["modelValue","class"]),l.v$.modal.form.group_id.$error?(o(),a("ul",pe,[(o(!0),a(x,null,h(l.v$.modal.form.group_id.$errors,(t,m)=>(o(),a("li",{class:"text-red-500",key:m},_(t.$message),1))),128))])):$("",!0)]),e("div",fe,[s(v,{value:"Reporte"}),s(k,{modelValue:i.modal.form.report_id,"onUpdate:modelValue":n[2]||(n[2]=t=>i.modal.form.report_id=t),type:"text",class:w(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.report_id.$error}]),required:"",autocomplete:"Reporte"},null,8,["modelValue","class"]),l.v$.modal.form.report_id.$error?(o(),a("ul",he,[(o(!0),a(x,null,h(l.v$.modal.form.report_id.$errors,(t,m)=>(o(),a("li",{class:"text-red-500",key:m},_(t.$message),1))),128))])):$("",!0)]),e("div",xe,[s(v,{value:"Dataset"}),s(k,{modelValue:i.modal.form.dataset_id,"onUpdate:modelValue":n[3]||(n[3]=t=>i.modal.form.dataset_id=t),type:"text",class:w(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.dataset_id.$error}]),required:"",autocomplete:"Dataset"},null,8,["modelValue","class"]),l.v$.modal.form.dataset_id.$error?(o(),a("ul",ge,[(o(!0),a(x,null,h(l.v$.modal.form.dataset_id.$errors,(t,m)=>(o(),a("li",{class:"text-red-500",key:m},_(t.$message),1))),128))])):$("",!0)])]),footer:d(()=>[s(q,{onClick:u.closeModal},{default:d(()=>[f(" Cancelar ")]),_:1},8,["onClick"]),i.modal.editMode?(o(),p(C,{key:0,class:"ml-3",onClick:u.update},{default:d(()=>[f(" Actualizar ")]),_:1},8,["onClick"])):(o(),p(C,{key:1,class:"ml-3",onClick:u.store},{default:d(()=>[f(" Guardar ")]),_:1},8,["onClick"]))]),_:1},8,["show","onClose"])]),_:1})}const De=H(J,[["render",ye]]);export{De as default};
