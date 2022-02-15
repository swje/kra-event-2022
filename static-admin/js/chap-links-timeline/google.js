
/**
 * @constructor links.Timeline.ItemLine
 * @extends links.Timeline.Item
 * User defined item type "line".
 */
var ItemLine = function (data, options) {
	links.Timeline.Item.call(this, data, options);
};

ItemLine.prototype = new links.Timeline.Item();

ItemLine.prototype.createDOM = function () {
	var _this = this;
	var divLine = document.createElement("DIV");
	divLine.style.position = "absolute";
	divLine.style.width = "0px";
	
	this.dom = divLine;
	this.updateDOM();

	return divLine;
};

ItemLine.prototype.showDOM = function (container) {
	var dom = this.dom;
	if (!dom) {
		dom = this.createDOM();
	}

	if (dom.parentNode != container) {
		if (dom.parentNode) {
			this.hideDOM();
		}

		container.insertBefore(dom, container.firstChild);
		this.rendered = true;
	}
};

ItemLine.prototype.hideDOM = function () {
	var dom = this.dom;
	if (dom) {
		var parent = dom.parentNode;
		if (parent) {
			parent.removeChild(dom);
			this.rendered = false;
		}
	}
};

ItemLine.prototype.updateDOM = function () {
	var divLine = this.dom;
	if (divLine) {

		// update class
		divLine.className = "timeline-event item-line";

		if (this.isCluster) {
			links.Timeline.addClassName(divLine, 'timeline-event-cluster');
		}

		// add item specific class name when provided
		if (this.className) {
			links.Timeline.addClassName(divLine, this.className);
		}
	}
};

ItemLine.prototype.updatePosition = function (timeline) {
	var dom = this.dom;
	if (dom) {
		var left = timeline.timeToScreen(this.start),
			axisOnTop = timeline.options.axisOnTop,
			axisTop = timeline.size.axis.top,
			axisHeight = timeline.size.axis.height

		dom.style.left = (left - this.lineWidth / 2) + "px";
		dom.style.top = "0px";
		dom.style.height = axisTop + "px";
	}
};

ItemLine.prototype.isVisible = function (start, end) {
	if (this.cluster) {
		return false;
	}

	return (this.start > start)
		&& (this.start < end);
};

ItemLine.prototype.setPosition = function (left, right) {
	var dom = this.dom;
	dom.style.left = (left - this.lineWidth / 2) + "px";
};

ItemLine.prototype.getRight = function (timeline) {
	return timeline.timeToScreen(this.start);
};

var timeline;

google.load("visualization", "1");

// Set callback to run when API is loaded

