/**
 * LICENCE[[
 * Version: MPL 1.1/GPL 2.0/LGPL 2.1/CeCILL 2.O
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is kelis.fr code.
 *
 * The Initial Developer of the Original Code is 
 * samuel.monsarrat@kelis.fr
 *
 * Portions created by the Initial Developer are Copyright (C) 2012-2013
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either of the GNU General Public License Version 2 or later (the "GPL"),
 * or the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * or the CeCILL Licence Version 2.0 (http://www.cecill.info/licences.en.html),
 * in which case the provisions of the GPL, the LGPL or the CeCILL are applicable
 * instead of those above. If you wish to allow use of your version of this file
 * only under the terms of either the GPL, the LGPL or the CeCILL, and not to allow
 * others to use your version of this file under the terms of the MPL, indicate
 * your decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL, the LGPL or the CeCILL. If you do not
 * delete the provisions above, a recipient may use your version of this file under
 * the terms of any one of the MPL, the GPL, the LGPL or the CeCILL.
 * ]]LICENCE
 */

/* === Doctek outline manager =============================================== */
var outMgr = {
	fPathRoot : "",
	fPathCat : "des:.outCat_i",
	fPathBranches : "des:div.outMnu_b",
	fUrlOutline : null,
	sFilterTgleClosed : scPaLib.compileFilter(".outMnu_tgle_c"),
	sFilterTgleClosed : scPaLib.compileFilter(".outMnu_tgle_c"),

	fStrings : ["Ouvrir le menu","Fermer le menu"],
	
/* === Public functions ===================================================== */
	init : function (pPathRoot){
		//scCoLib.util.log("outMgr.init");
		this.fIsLocal = window.location.protocol == "file:";
		if (typeof pPathRoot != "undefined") this.fPathRoot = pPathRoot;
		this.fFilterIsClosed = scPaLib.compileFilter(".outMnu_sub_c");
		this.fFilterIsBranch = scPaLib.compileFilter(".outMnu_b");
		scOnLoads[scOnLoads.length] = this;
	},

	declareOutline : function(pUrl){
		//scCoLib.util.log("outMgr.declareOutline: "+pUrl);
		this.fUrlOutline = pUrl;
	},
	
	onLoad : function(){
		//scCoLib.util.log("outMgr.onLoad");
		try{
			this.fRoot = scPaLib.findNode(this.fPathRoot);
			if (!this.fRoot) return;
			this.fCurrentItem = scPaLib.findNode("des:div.outMnu_sel_yes", this.fRoot);
			this.fRoot.className = this.fRoot.className.replace("mnu_static", "mnu_dynamic");
			var vBranches = scPaLib.findNodes(this.fPathBranches,this.fRoot);
			for (var i=0; i < vBranches.length; i++) {
				var vLbl = vBranches[i];
				var vSub = scPaLib.findNode("nsi:ul",vLbl);
				vLbl.fTglBtn = this.xAddBtn(vLbl,"outMnu_tgle_"+(vSub?"o":"c"),(vSub?"v":">"),(vSub?this.fStrings[1]:this.fStrings[0]),vLbl.firstChild);
				vLbl.fTglBtn.onclick = this.sToggleItem;
				vLbl.fTglBtn.fLbl = vLbl;
				vLbl.fTglBtn.fUl = vSub;
			}

		} catch(e){
			scCoLib.util.log("ERROR - outMgr.onLoad: "+e);
		}
	},

	loadSortKey : "ZZ",

/* === Callback functions =================================================== */
	sToggleItem : function() {
		try{
			outMgr.xToggleItem(this,false);
		} catch(e){}
		return false;
	},
	/** outMgr.sOnFilter : Filter callback : called on search a successful. */
	sOnFilter : function(pPageList){
		//scCoLib.util.log("outMgr.sOnFilter");
		for (var i=0; i< outMgr.fMenus.length;i++) outMgr.fMenus[i].applyFilter(pPageList);
	},
	/** outMgr.sOnReset : Filter reset callback : called search reset. */
	sOnReset : function(){
		//scCoLib.util.log("outMgr.sOnReset");
		for (var i=0; i< outMgr.fMenus.length;i++) outMgr.fMenus[i].resetFilter();
	},

/* === Private functions ==================================================== */
	xToggleItem : function(pBtn) {
		if (!pBtn) return;
		var vStatus = pBtn.className;
		if (!pBtn.fUl) this.xBuildSub(pBtn);
		var vUl = pBtn.fUl;
		if (!vUl) return;
		if(vStatus == "outMnu_tgle_c") {
			pBtn.className = "outMnu_tgle_o";
			pBtn.innerHTML = "<span>v</span>";
			pBtn.title = this.fStrings[1];
			vUl.className = vUl.className.replace("outMnu_sub_c", "outMnu_sub_o");
			vUl.style.display = "";
			vUl.fClosed = false;
		} else {
			pBtn.className = "outMnu_tgle_c";
			pBtn.innerHTML = "<span>></span>";
			pBtn.title = this.fStrings[0];
			vUl.className = vUl.className.replace("outMnu_sub_o", "outMnu_sub_c");
			vUl.style.display = "none";
			vUl.fClosed = true;
			var vOpendSubMnus = scPaLib.findNodes("des:ul.outMnu_sub_o",vUl);
			for (var j=0; j < vOpendSubMnus.length; j++) this.xAutoToggleItem(vOpendSubMnus[j].fTglBtn);
		}
		this.scrollTask.checkBtn();
	},

	xBuildSub : function(pBtn) {
		if (!this.fOutline) this.xInitOutline();
		var vLbl = pBtn.fLbl;
		pBtn.fUl = this.xAddElt("ul",vLbl.parentNode,"outMnu_sub outMnu_sub_o");
		pBtn.fUl.fTglBtn = pBtn;
		var vLi, vDiv, vLnk, vType, vCls;
		var vChildren = vLbl.fSrc.children;
		for (var i=0; i < pBtn.fLbl.fSrc.children.length; i++){
			var vChi =vChildren[i];
			vType = vChi.children ? "b" : "l";
			vCls = "outMnu_sel_no outMnu_"+vType+" outMnu_typ_"+vChi.source+" outMnu_dpt_"+(scPaLib.findNodes("anc:ul.outMnu_sub", pBtn).length + 1)+" "+vChi.className;
			vLi = this.xAddElt("li",pBtn.fUl,vCls);
			vDiv = this.xAddElt("div",vLi,"outMnuLbl "+vCls);
			vDiv.fSrc = vChi;
			vLnk = this.xAddElt("a",vDiv,"outMnu_i outMnu_lnk");
			if (vChi.url && vChi.url != "null") {
				vLnk.href = scServices.scLoad.getPathFromRoot(vChi.url);
				vLnk.target = "_self";
			} else {
				vLnk.href = "#";
				vLnk.onclick = function(){try{if(this.fTglBtn && this.fTglBtn.className.indexOf("outMnu_tgle_c")>=0){outMgr.xToggleItem(this.fTglBtn)}} catch(e){};return false;};
			}
			vLnk.innerHTML = '<span class="outMnu_ti">'+vChi.label+'</span>';
			if (vType == "b"){
				vDiv.fTglBtn = vLnk.fTglBtn = this.xAddBtn(vDiv,"outMnu_tgle_c",">",null,vDiv.firstChild);
				vDiv.fTglBtn.onclick = this.sToggleItem;
				vDiv.fTglBtn.fLbl = vDiv;
			}
		}
	},

	xGetCurrentCategory : function() {
		var vCategories = scPaLib.findNodes(this.fPathCat);
		if (vCategories.length ==0) return null;
		for (var i = 0; i < vCategories.length; i++) {
			if(!vCategories[i].href) return i;
		};
	},

	xInitOutline : function() {
		//scCoLib.util.log("outMgr.xInitOutline");
		try{
			var vReq = this.xGetHttpRequest();
			vReq.open("GET",this.fUrlOutline,false);
			vReq.send();
			var vMenu = this.xDeserialiseObjJs(vReq.responseText).menu;
			var vCategory = this.xGetCurrentCategory();
			this.fOutline = (typeof vCategory == "number") ? vMenu.children[vCategory] : vMenu;
			var iOutlineWalker = function (pNode, pSrc) {
				var vChildren = scPaLib.findNodes("chi:li/chi:div.outMnuLbl", pNode);
				for (var i=0; i < vChildren.length; i++){
					var vChild = vChildren[i];
					vChild.fSrc = pSrc.children[i];
					if (scPaLib.checkNode(outMgr.fFilterIsBranch,vChild)) iOutlineWalker(scPaLib.findNode("nsi:ul",vChild),pSrc.children[i]);
				}
			}
			iOutlineWalker( (typeof vCategory == "number") ? scPaLib.findNode("chi:li/chi:ul", this.fRoot) : this.fRoot, this.fOutline);
		}catch(e){
			scCoLib.util.log("ERROR - outMgr.xInitOutline : "+e);
		}
	},

	xGetOutline : function() {
		//scCoLib.util.log("outMgr.xGetOutline");
		try{
			var vReq = this.xGetHttpRequest();
			vReq.open("GET",this.fUrlOutline,false);
			vReq.send();
			return this.xDeserialiseObjJs(vReq.responseText);
		}catch(e){
			//scCoLib.util.log("ERROR - outMgr.xInitOutline : "+e);
		}
	},

	/* === Utilities ========================================================== */
	/** outMgr.xAddElt : Add an HTML element to a parent node. */
	xAddElt : tplMgr.xAddElt,

	/** outMgr.xAddBtn : Add a HTML button to a parent node. */
	xAddBtn : tplMgr.xAddBtn,

	/** outMgr.xSwitchClass - replace a class name. */
	xSwitchClass : tplMgr.xSwitchClass,

	xGetHttpRequest: function(){
		if (window.XMLHttpRequest && (!this.fIsLocal || !window.ActiveXObject)) return new XMLHttpRequest();
		else if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
	},

	xDeserialiseObjJs : function(pStr){
		if(!pStr) return {};
		var vVal;
		eval("vVal="+pStr);
		return vVal;
	}
}