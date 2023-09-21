import{_ as E}from"./AppLayout-8fe3f272.js";import{_ as I}from"./PrimaryButton-6b407ce1.js";import{_ as V}from"./SecondaryButton-e98c9091.js";import{a as P}from"./DialogModal-ee4749fc.js";import{_ as q}from"./TextInput-3032170e.js";import{_ as D}from"./InputError-4ed85ba8.js";import{u as L,r as N,a as A}from"./i18n-validators-e56c5a18.js";import{_ as O}from"./InputLabel-6da3f361.js";import{_ as S}from"./Checkbox-fe648b67.js";import{_ as T}from"./DangerButton-e1127d4a.js";import{_ as z}from"./CustomButton-4583b0df.js";import{_ as F}from"./_plugin-vue_export-helper-c27b6911.js";import{I as r,L as G,o as t,c,w as a,a as e,D as v,b as l,g as u,e as i,h as k,F as w,t as m,n as U,f as j}from"./app-826d0887.js";const H={setup(){return{v$:L()}},components:{CustomButton:z,DangerButton:T,Checkbox:S,InputLabel:O,InputError:D,TextInput:q,PrimaryButton:I,SecondaryButton:V,AppLayout:E,DialogModal:P},props:{permissions:Array},validations(){return{modal:{form:{id:{requiredIf:N(this.modal.editMode)},name:{required:A}}}}},data(){return{records:this.permissions,modal:{title:"",editMode:!1,open:!1,form:{id:"",name:""}}}},methods:{create(){this.modal.open=!0,this.modal.title="Crear Permiso"},edit(o){this.modal={title:"Editar Permiso",editMode:!0,open:!0,form:{id:o.id,name:o.name}}},store(){this.v$.modal.form.$touch(),this.v$.modal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.post(route("permissions.store"),this.modal.form).then(o=>{this.closeModal(),this.records=o.data}).catch(o=>{this.$swal({icon:"error",title:"ERROR",text:o.response.data})})},update(){this.v$.modal.form.$touch(),this.v$.modal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.put(route("permissions.update",this.modal.form.id),this.modal.form).then(o=>{this.closeModal(),this.records=o.data}).catch(o=>{this.$swal({icon:"error",title:"ERROR",text:o.response.data})})},destroy(o){this.$swal({icon:"question",title:"¿Eliminar Permiso?",text:"¡Esta acción no es reversible!",showCancelButton:!0,confirmButtonText:"¡Si, Eliminar!"}).then(_=>{_.isConfirmed&&axios.delete(route("permissions.destroy",o)).then(f=>{this.records=f.data}).catch(f=>{this.$swal({icon:"error",title:"ERROR",text:f.response.data})})})},closeModal(){this.modal={title:"",editMode:!1,open:!1,form:{id:"",name:""}},this.v$.modal.form.$reset()}}},J={class:"flex flex-row"},K=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Permisos ",-1),Q={class:"py-12"},W={class:"max-w-8xl mx-6 sm:px-6 lg:px-8"},X={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},Y={class:"py-2 align-middle inline-block min-w-full"},Z={class:"shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"},ee={class:"min-w-full divide-y divide-gray-200"},te=e("thead",{class:"bg-gray-50"},[e("tr",null,[e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Nombre "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Roles asociados "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Creado el "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Actualizado el ")])],-1),oe={class:"bg-white divide-y divide-gray-200"},se={class:"px-6 py-4 text-center text-sm font-medium"},ae={class:"flex flex-row"},re={class:"px-6 py-4 text-left text-sm font-medium"},ie={class:"px-6 py-4 text-left text-sm font-medium"},ne={class:"text-xs font-semibold inline-block py-1 px-2 rounded text-indigo-600 bg-indigo-200 uppercase last:mr-0 mr-1"},le={key:1,class:"text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1"},de={class:"px-6 py-4 text-left text-sm font-medium"},ce={class:"px-6 py-4 text-left text-sm font-medium"},me={class:"mt-4"},pe={key:0,class:"mt-1"};function ue(o,_,f,x,d,n){const h=r("font-awesome-icon"),y=r("PrimaryButton"),C=r("CustomButton"),b=r("InputLabel"),$=r("TextInput"),B=r("SecondaryButton"),R=r("DialogModal"),M=r("AppLayout"),g=G("permission");return t(),c(M,{title:"Permisos"},{header:a(()=>[e("div",J,[K,v((t(),c(y,{type:"button",class:"ml-auto",onClick:n.create},{default:a(()=>[l(h,{icon:"plus",class:"mr-2"}),u(" Crear ")]),_:1},8,["onClick"])),[[g,"permission.create"]])])]),default:a(()=>[e("div",Q,[e("div",W,[e("div",X,[e("div",Y,[e("div",Z,[e("table",ee,[te,e("tbody",oe,[(t(!0),i(w,null,k(d.records,s=>(t(),i("tr",null,[e("td",se,[e("div",ae,[v((t(),c(C,{class:"mr-2",onClick:p=>n.edit(s)},{default:a(()=>[l(h,{icon:["far","pen-to-square"]})]),_:2},1032,["onClick"])),[[g,"permission.edit"]]),v((t(),c(C,{onClick:p=>n.destroy(s.id)},{default:a(()=>[l(h,{icon:["far","trash-can"]})]),_:2},1032,["onClick"])),[[g,"permission.destroy"]])])]),e("td",re,m(s.name),1),e("td",ie,[s.roles.length>0?(t(!0),i(w,{key:0},k(s.roles,(p,_e)=>(t(),i("span",ne,m(p.name),1))),256)):(t(),i("span",le," sin roles asociados "))]),e("td",de,m(s.created_at),1),e("td",ce,m(s.updated_at),1)]))),256))])])])])])])]),l(R,{show:d.modal.open,onClose:n.closeModal},{title:a(()=>[u(m(d.modal.title),1)]),content:a(()=>[e("div",me,[l(b,{value:"Nombre"}),l($,{modelValue:d.modal.form.name,"onUpdate:modelValue":_[0]||(_[0]=s=>d.modal.form.name=s),type:"text",class:U(["mt-1 block w-full",{"border-red-500":x.v$.modal.form.name.$error}]),required:"",autocomplete:"Nombre"},null,8,["modelValue","class"]),x.v$.modal.form.name.$error?(t(),i("ul",pe,[(t(!0),i(w,null,k(x.v$.modal.form.name.$errors,(s,p)=>(t(),i("li",{class:"text-red-500",key:p},m(s.$message),1))),128))])):j("",!0)])]),footer:a(()=>[l(B,{onClick:n.closeModal},{default:a(()=>[u(" Cancelar ")]),_:1},8,["onClick"]),d.modal.editMode?(t(),c(y,{key:0,class:"ml-3",onClick:n.update},{default:a(()=>[u(" Actualizar ")]),_:1},8,["onClick"])):(t(),c(y,{key:1,class:"ml-3",onClick:n.store},{default:a(()=>[u(" Guardar ")]),_:1},8,["onClick"]))]),_:1},8,["show","onClose"])]),_:1})}const Me=F(H,[["render",ue]]);export{Me as default};
