/*
 * Author : ez
 * Describe : 常用工具函数
 * Date : 2016/5/15
 */
/*
 * Get url from module and function name.
 * _param : [{opt, val}, {opt1, val1}, ...]
 */
function _get_entry_url (_mod, _func, _param) {
	var i = 0;
	var _url = 'http://' + window.location.host +
		'/EZSYS/src/index.php/' + _mod + '/' + _func;
	if (arguments.length == 3) {
		_url += '?';
		for (; i < _param.length - 1; i ++) {
			_url += _param [i].opt + 
				'=' + _param [i].val + '&';
		}
		_url += _param [i].opt + 
			'=' + _param [i].val;
	}
	return _url;
}
/*
 * _outer: The layout div or object.
 * _cols: the column names, array.
 * return: The layout object.
 */
function _create_tb_head (_outer, _cols) {
	_outer.empty ();
	var tr = '<tr>';
	var i = 0;
	for (; i < _cols.length; i ++) 
		tr += '<th>' + _cols [i] + '</th>';
	tr += '</tr>';
	return _outer.html (tr);
}

/*
 * _pnum: page number.
 * My own pager plugin.
 */
function _create_pager (_outer, _cnt, _func) {
	var content = '<a start=0 title="首页">&laquo;首页</a>';
	if (_cnt <= 6) {
		content += '<a start=0 title="上一页">&laquo;上一页</a>' +
			'<a start=0 title="下一页">&laquo;下一页</a>' +
			'<a start=0 title="下一页">&laquo;尾页</a>';
	} else {
		var page_cnt = Math.floor (_cnt / 6);
		var page_mod = _cnt % 6;
		content += '<a start=' + (current_page == 0 ? 0 : current_page - 1) 
			+ ' title="上一页">&laquo;上一页</a>';
		if (page_cnt <= 4) {
			if (page_mod == 0) 
				for (var i = 0; i < page_cnt; ) {
					content += '<a start=' + i + ' class="number">' + 
						(++ i) + '</a>';
				}
			else 
				for (var i = 0; i <= page_cnt;) {
					content += '<a start=' + i + ' class="number">' + 
						(++ i) + '</a>';
				}
		} else { // page_cnt > 4
			if (current_page >= page_cnt - 2) 
				content += '<a start=' + page_cnt - 2 + ' class="number">' + 
					(page_cnt - 1) + '</a>' + 
					'<a start=' + (page_cnt - 1) + ' class="number">' + page_cnt +
					'</a>' + '<a start=' + page_cnt + ' class="number">' + 
					(page_cnt + 1) + '</a>';
			else 
				content += '<a start=' + current_page + ' class="number">' + 
					(current_page + 1) + '</a>' + 
					'<a start=' + (current_page + 1) + 
					' class="number">' +(current_page + 2) +
					'</a>...' + '<a start=' + page_cnt + ' class="number">' + 
					(page_cnt + 1) + '</a>';
		}
		content += '<a start=' + (current_page + 1) + 
			' title="下一页">&laquo;下一页</a>' + '<a start=' + 
			(page_cnt) + ' title="尾页">&laquo;尾页</a>';
	}
	_outer.html (content)
		.children ().click (_func);
}

// function _bind_msg_facebox () {
// 	$('a[rel*=msg]').each (function () {
// 		$(this).unbind ('click').click (function () {
// 			var mid = $(this).attr ('mid');
// 			$.get (_get_entry_url ('Message', 'get_msg', 
// 				[{opt:'kid', val:mid}]), function (_dt) {
// 					var outer = $('#msg');
// 					outer.children ('p.msg-box-info i').text (_dt.msg_update_date);
// 					outer.children ('p.msg-box-info a').text (_dt.msg_rcver_id);
// 					outer.children ('p.msg-box-body').text (_dt.msg_describe);
// 			});
// 			$(this).facebox ();
// 		});
// 	})
// }

/*
 * Author : ez
 * Date : 2016/5/24
 * Describe : 创建主页中的一个条目html
 */
function _create_item (_data) {
	var html = '<div class="item-container"><p class="item-title">' + 
		_data.name + '<a class="item-author">作者:<b>' + _data.acc + 
		'</b></a><a class="item-cate">'+ _data.ctnm +
		'</a><a kid="'+ _data.kid +
		'" onclick="slide_down_up (this);" class="item-open">打开</a></p><div class="item-desc">'
		+ _data.dscr+ '</div>' + 
		'<div class="item-bottom"><a kid="'+ _data.kid + '" onclick="like_it (this);"><i class="item-bottom-like"></i>喜欢(<b>' +
		_data.lk + '</b>)</a>|<a><i class="item-bottom-comm"></i>打开评论(<b>21</b>)</a>|<a><i class="item-bottom-share" style="width:12px;"></i>分享</a>|<a>'
		+ _data.dt + '</a></div></div>';
	return html;
}
