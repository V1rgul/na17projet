/* Optim Office page manager */
var tplMgr = {
	fCbkInit : true,
	fCbkPath : "des:.cbkClosed",
	fBkBtnPath : "des:.outBkBtn/des:a",
	fListeners : {showSearch:[],resetSearch:[]},

	init : function(){
		var vHash = window.location.hash;
		if (vHash.length>0); vHash = vHash.substring(1);
		
		// Close collapsable blocks that are closed by default.
		if (this.fCbkInit){
			var vCbks = scPaLib.findNodes(this.fCbkPath);
			for (var i in vCbks) {
				if (!vHash || vHash && vHash != scPaLib.findNode("chi:", vCbks[i]).id) {
					var vTgl = scPaLib.findNode("des:a", vCbks[i]);
					if (vTgl) vTgl.onclick();
				}
			}
		}
		if ("scTooltipMgr" in window ) {
			scTooltipMgr.addShowListener(this.sTtShow);
			scTooltipMgr.addHideListener(this.sTtHide);
		}
		this.fCurrentUrl = document.location.href;
		this.fPageCurrent = "co/"+this.fCurrentUrl.substring(this.fCurrentUrl.lastIndexOf("/")+1);
		this.fStore = new this.LocalStore();
	},
	saveLocation : function() {
		this.fStore.set("lastPageUrl", document.location.href);
	},
	loadPage : function(pUrl){
		scCoLib.util.log("tplMgr.loadPage : "+pUrl);
		if (pUrl && pUrl.length>0) {
			window.location.href = scServices.scLoad.getPathFromRoot(pUrl);
		}
	},
	scrollTo : function(pId){
		this.loadPage(this.fPageCurrent +"#" + pId);
	},
	setBackButtons : function() {
		var vBkBtns = scPaLib.findNodes(this.fBkBtnPath);
		for (var i in vBkBtns) vBkBtns[i].onclick=function(){var vUrl = tplMgr.fStore.get("lastPageUrl");if(vUrl) this.setAttribute("href", vUrl)};
	},
	xMediaFallback: function(pMedia) {
		while (pMedia.firstChild) {
			if (pMedia.firstChild instanceof HTMLSourceElement) {
				pMedia.removeChild(pMedia.firstChild);
			} else {
				pMedia.parentNode.insertBefore(pMedia.firstChild, pMedia);
			}
		}
		pMedia.parentNode.removeChild(pMedia);
	},
	
	/* === Utilities ============================================================ */
	/** tplMgr.xAddBtn : Add a HTML button to a parent node. */
	xAddBtn : function(pParent, pClassName, pCapt, pTitle, pNxtSib) {
		var vBtn = pParent.ownerDocument.createElement("a");
		vBtn.className = pClassName;
		vBtn.fName = pClassName;
		vBtn.href = "#";
		vBtn.target = "_self";
		if (pTitle) vBtn.setAttribute("title", pTitle);
		if (pCapt) vBtn.innerHTML = '<span class="capt">' + pCapt + '</span>';
		if (pNxtSib) pParent.insertBefore(vBtn,pNxtSib);
		else pParent.appendChild(vBtn);
		return vBtn;
	},

	/** tplMgr.xAddElt : Add an HTML element to a parent node. */
	xAddElt : function(pName, pParent, pClassName, pNoDisplay, pHidden, pNxtSib){
		var vElt;
		if(scCoLib.isIE && pName.toLowerCase() == "iframe") {
			//BUG IE : impossible de masquer les bordures si on ajoute l'iframe via l'API DOM.
			var vFrmHolder = pParent.ownerDocument.createElement("div");
			if (pNxtSib) pParent.insertBefore(vFrmHolder,pNxtSib);
			else pParent.appendChild(vFrmHolder);
			vFrmHolder.innerHTML = "<iframe scrolling='no' frameborder='0'></iframe>";
			vElt = vFrmHolder.firstChild;
		} else {
			vElt = pParent.ownerDocument.createElement(pName);
			if (pNxtSib) pParent.insertBefore(vElt,pNxtSib);
			else pParent.appendChild(vElt);
		}
		if (pClassName) vElt.className = pClassName;
		if (pNoDisplay) vElt.style.display = "none";
		if (pHidden) vElt.style.visibility = "hidden";
		return vElt;
	},

	/** tplMgr.xSwitchClass - replace a class name. */
	xSwitchClass : function(pNode, pClassOld, pClassNew, pAddIfAbsent, pMatchExact) {
		var vAddIfAbsent = typeof pAddIfAbsent == "undefined" ? false : pAddIfAbsent;
		var vMatchExact = typeof pMatchExact == "undefined" ? true : pMatchExact;
		var vClassName = pNode.className;
		var vReg = new RegExp("\\b"+pClassNew+"\\b");
		if (vMatchExact && vClassName.match(vReg)) return;
		var vClassFound = false;
		if (pClassOld && pClassOld != "") {
			if (vClassName.indexOf(pClassOld)==-1){
				if (!vAddIfAbsent) return;
				else if (pClassNew && pClassNew != '') pNode.className = vClassName + " " + pClassNew;
			} else {
				var vCurrentClasses = vClassName.split(' ');
				var vNewClasses = new Array();
				for (var i = 0, n = vCurrentClasses.length; i < n; i++) {
					var vCurrentClass = vCurrentClasses[i];
					if (vMatchExact && vCurrentClass != pClassOld || !vMatchExact && vCurrentClass.indexOf(pClassOld) != 0) {
						vNewClasses.push(vCurrentClasses[i]);
					} else {
						if (pClassNew && pClassNew != '') vNewClasses.push(pClassNew);
						vClassFound = true;
					}
				}
				pNode.className = vNewClasses.join(' ');
			}
		}
		return vClassFound;
	},
	/** Tooltip lib show callback */
	sTtShow: function(pNode) {
		var vClsBtn = scPaLib.findNode("des:a.tt_x", scTooltipMgr.fCurrTt);
		if (vClsBtn) window.setTimeout(function(){vClsBtn.focus();}, pNode.fOpt.DELAY + 10);
	},
	/** Tooltip lib hide callback : this = scTooltipMgr */
	sTtHide: function(pNode) {
		if (pNode) pNode.focus();
	},
	/** Local Storage API (localStorage/userData/cookie) */
	LocalStore : function (pId){
		if (pId && !/^[a-z][a-z0-9]+$/.exec(pId)) throw new Error("Invalid store name");
		this.fId = pId || "";
		this.fRootKey = document.location.pathname.substring(0,document.location.pathname.lastIndexOf("/")) +"/";
		if ("localStorage" in window) {
			this.get = function(pKey) {var vRet = localStorage.getItem(this.fRootKey+this.xKey(pKey));return (typeof vRet == "string" ? unescape(vRet) : null)};
			this.set = function(pKey, pVal) {localStorage.setItem(this.fRootKey+this.xKey(pKey), escape(pVal))};
		} else if (window.ActiveXObject){
			this.get = function(pKey) {this.xLoad();return this.fIE.getAttribute(this.xEsc(pKey))};
			this.set = function(pKey, pVal) {this.fIE.setAttribute(this.xEsc(pKey), pVal);this.xSave()};
			this.xLoad = function() {this.fIE.load(this.fRootKey+this.fId)};
			this.xSave = function() {this.fIE.save(this.fRootKey+this.fId)};
			this.fIE=document.createElement('div');
			this.fIE.style.display='none';
			this.fIE.addBehavior('#default#userData');
			document.body.appendChild(this.fIE);
		} else {
			this.get = function(pKey){var vReg=new RegExp(this.xKey(pKey)+"=([^;]*)");var vArr=vReg.exec(document.cookie);if(vArr && vArr.length==2) return(unescape(vArr[1]));else return null};
			this.set = function(pKey,pVal){document.cookie = this.xKey(pKey)+"="+escape(pVal)};
		}
		this.xKey = function(pKey){return this.fId + this.xEsc(pKey)};
		this.xEsc = function(pStr){return "LS" + pStr.replace(/ /g, "_")};
	}
}


