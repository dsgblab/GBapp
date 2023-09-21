import{_ as L}from"./AppLayout-8fe3f272.js";import{_ as R}from"./PrimaryButton-6b407ce1.js";import{_ as D}from"./TextInput-3032170e.js";import{k as N,I as u,L as T,o,c as p,w as c,a as e,D as B,b as i,g as v,e as s,h as _,F as x,t as d,n as g,f as k}from"./app-826d0887.js";import{_ as A}from"./CustomButton-4583b0df.js";import{_ as F}from"./SecondaryButton-e98c9091.js";import{_ as O}from"./InputLabel-6da3f361.js";import{a as S}from"./DialogModal-ee4749fc.js";import{u as U,r as P,a as b}from"./i18n-validators-e56c5a18.js";import{_ as z}from"./_plugin-vue_export-helper-c27b6911.js";const G={setup(){return{v$:U()}},components:{DialogModal:S,InputLabel:O,SecondaryButton:F,CustomButton:A,Link:N,TextInput:D,PrimaryButton:R,AppLayout:L},props:{filters:Array},validations(){return{modal:{form:{id:{requiredIf:P(this.modal.editMode)},name:{required:b},table:{required:b},column:{required:b},operator:{required:b},values:{required:b}}}}},data(){return{records:this.filters,modal:{title:"",editMode:!1,open:!1,form:{id:"",name:"",table:"",column:"",operator:"",values:""}}}},methods:{store(){this.v$.modal.form.$touch(),this.v$.modal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.post(route("filters.store"),this.modal.form).then(r=>{this.closeModal(),this.records=r.data}).catch(r=>{this.$swal({icon:"error",title:"ERROR",text:r.response.data})})},update(){this.v$.modal.form.$touch(),this.v$.modal.form.$invalid?this.$swal({icon:"error",title:"ERROR",text:"Verifica que toda la información este correctamente diligenciada"}):axios.put(route("filters.update",this.modal.form.id),this.modal.form).then(r=>{this.closeModal(),this.records=r.data}).catch(r=>{this.$swal({icon:"error",title:"Error",text:r.response.data})})},create(){this.modal.open=!0,this.modal.title="Agregar filtro"},edit(r){this.modal={title:"Editar filtro",editMode:!0,open:!0,form:{id:r.id,name:r.name,table:r.table,column:r.column,operator:r.operator,values:r.values}}},destroy(r){this.$swal({icon:"question",title:"¿Eliminar filtro?",text:"¡Esta acción no es reversible!",showCancelButton:!0,confirmButtonText:"¡Si, Eliminar!"}).then(m=>{m.isConfirmed&&axios.delete(route("filters.destroy",r)).then(w=>{this.records=w.data}).catch(w=>{this.$swal({icon:"error",title:"Error",text:w.response.data})})})},closeModal(){this.modal={title:"",editMode:!1,open:!1,form:{id:"",name:"",table:"",column:"",operator:"",values:""}},this.v$.modal.form.$reset()}}},j={class:"flex flex-row"},H=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Filtros ",-1),J={class:"py-12"},K={class:"max-w-8xl mx-6 sm:px-6 lg:px-8"},Q={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},W={class:"py-2 align-middle inline-block min-w-full"},X={class:"shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"},Y={class:"min-w-full divide-y divide-gray-200"},Z=e("thead",{class:"bg-gray-50"},[e("tr",null,[e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Nombre "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Tabla "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Columna "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Operador "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Valor "),e("th",{scope:"col",class:"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Creado el ")])],-1),ee={class:"bg-white divide-y divide-gray-200"},te={class:"px-6 py-4 text-center text-sm font-medium"},oe={class:"flex flex-row"},se={class:"px-6 py-4 text-left text-sm font-medium"},re={class:"px-6 py-4 text-left text-sm font-medium"},le={class:"px-6 py-4 text-left text-sm font-medium"},ae={class:"px-6 py-4 text-left text-sm font-medium"},ie={class:"px-6 py-4 text-left text-sm font-medium"},me={class:"px-6 py-4 text-left text-sm font-medium"},de={key:1},ne=e("td",{colspan:"9",class:"px-6 py-4 text-center text-sm font-medium text-red-500"}," No se encontraron registros… ",-1),ce=[ne],ue={class:"mt-4"},fe={key:0,class:"mt-1"},pe={class:"mt-4"},_e={key:0,class:"mt-1"},xe={class:"mt-4"},he={key:0,class:"mt-1"},ye={class:"mt-4"},ve={key:0,class:"mt-1"},ge={class:"mt-4"},ke={key:0,class:"mt-1"};function be(r,m,w,l,a,f){const C=u("font-awesome-icon"),$=u("PrimaryButton"),M=u("CustomButton"),h=u("InputLabel"),y=u("TextInput"),q=u("SecondaryButton"),E=u("DialogModal"),I=u("AppLayout"),V=T("permission");return o(),p(I,{title:"Filtros"},{header:c(()=>[e("div",j,[H,B((o(),p($,{type:"button",class:"ml-auto",onClick:f.create},{default:c(()=>[i(C,{icon:"plus",class:"mr-2"}),v(" Crear ")]),_:1},8,["onClick"])),[[V,"filter.create"]])])]),default:c(()=>[e("div",J,[e("div",K,[e("div",Q,[e("div",W,[e("div",X,[e("table",Y,[Z,e("tbody",ee,[a.records.length>0?(o(!0),s(x,{key:0},_(a.records,t=>(o(),s("tr",null,[e("td",te,[e("div",oe,[B((o(),p(M,{class:"mr-2",onClick:n=>f.edit(t)},{default:c(()=>[i(C,{icon:["far","pen-to-square"]})]),_:2},1032,["onClick"])),[[V,"filter.edit"]]),B((o(),p(M,{onClick:n=>f.destroy(t.id)},{default:c(()=>[i(C,{icon:["far","trash-can"]})]),_:2},1032,["onClick"])),[[V,"filter.destroy"]])])]),e("td",se,d(t.name),1),e("td",re,d(t.table),1),e("td",le,d(t.column),1),e("td",ae,d(t.operator),1),e("td",ie,d(t.values),1),e("td",me,d(t.created_at),1)]))),256)):(o(),s("tr",de,ce))])])])])])])]),i(E,{show:a.modal.open,onClose:f.closeModal},{title:c(()=>[v(d(a.modal.title),1)]),content:c(()=>[e("div",ue,[i(h,{value:"Nombre"}),i(y,{modelValue:a.modal.form.name,"onUpdate:modelValue":m[0]||(m[0]=t=>a.modal.form.name=t),type:"text",class:g(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.name.$error}]),required:""},null,8,["modelValue","class"]),l.v$.modal.form.name.$error?(o(),s("ul",fe,[(o(!0),s(x,null,_(l.v$.modal.form.name.$errors,(t,n)=>(o(),s("li",{class:"text-red-500",key:n},d(t.$message),1))),128))])):k("",!0)]),e("div",pe,[i(h,{value:"Tabla"}),i(y,{modelValue:a.modal.form.table,"onUpdate:modelValue":m[1]||(m[1]=t=>a.modal.form.table=t),type:"text",class:g(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.table.$error}]),required:""},null,8,["modelValue","class"]),l.v$.modal.form.table.$error?(o(),s("ul",_e,[(o(!0),s(x,null,_(l.v$.modal.form.table.$errors,(t,n)=>(o(),s("li",{class:"text-red-500",key:n},d(t.$message),1))),128))])):k("",!0)]),e("div",xe,[i(h,{value:"Columna"}),i(y,{modelValue:a.modal.form.column,"onUpdate:modelValue":m[2]||(m[2]=t=>a.modal.form.column=t),type:"text",class:g(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.column.$error}]),required:""},null,8,["modelValue","class"]),l.v$.modal.form.column.$error?(o(),s("ul",he,[(o(!0),s(x,null,_(l.v$.modal.form.column.$errors,(t,n)=>(o(),s("li",{class:"text-red-500",key:n},d(t.$message),1))),128))])):k("",!0)]),e("div",ye,[i(h,{value:"Operador"}),i(y,{modelValue:a.modal.form.operator,"onUpdate:modelValue":m[3]||(m[3]=t=>a.modal.form.operator=t),type:"text",class:g(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.operator.$error}]),required:""},null,8,["modelValue","class"]),l.v$.modal.form.operator.$error?(o(),s("ul",ve,[(o(!0),s(x,null,_(l.v$.modal.form.operator.$errors,(t,n)=>(o(),s("li",{class:"text-red-500",key:n},d(t.$message),1))),128))])):k("",!0)]),e("div",ge,[i(h,{value:"Valor"}),i(y,{modelValue:a.modal.form.values,"onUpdate:modelValue":m[4]||(m[4]=t=>a.modal.form.values=t),type:"text",class:g(["mt-1 block w-full",{"border-red-500":l.v$.modal.form.values.$error}]),required:""},null,8,["modelValue","class"]),l.v$.modal.form.values.$error?(o(),s("ul",ke,[(o(!0),s(x,null,_(l.v$.modal.form.values.$errors,(t,n)=>(o(),s("li",{class:"text-red-500",key:n},d(t.$message),1))),128))])):k("",!0)])]),footer:c(()=>[i(q,{onClick:f.closeModal},{default:c(()=>[v(" Cancelar ")]),_:1},8,["onClick"]),a.modal.editMode?(o(),p($,{key:0,class:"ml-3",onClick:f.update},{default:c(()=>[v(" Actualizar ")]),_:1},8,["onClick"])):(o(),p($,{key:1,class:"ml-3",onClick:f.store},{default:c(()=>[v(" Guardar ")]),_:1},8,["onClick"]))]),_:1},8,["show","onClose"])]),_:1})}const Re=z(G,[["render",be]]);export{Re as default};
