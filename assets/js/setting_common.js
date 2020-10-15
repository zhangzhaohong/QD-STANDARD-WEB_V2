function loginSuccess() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('登陆管理中心成功！', {
        type: 'info',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        window.location.href = './';
    }, 500);
}

function welcomeBack() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('管理员，欢迎回来！', {
        type: 'info',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
    }, 1000);
}

function codeWrong() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('验证码错误！', {
        type: 'warning',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        history.go(-1);
    }, 1000);
}

function idCodeWrong() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('用户名或密码不正确！', {
        type: 'warning',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        history.go(-1);
    }, 1000);
}

function logoutMessage() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('您已成功注销本次登陆！', {
        type: 'success',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        window.location.href = './login.php';
    }, 1000);
}

function isloginMessage() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('您已登陆！', {
        type: 'success',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        window.location.href = './';
    }, 500);
}

function SuccessMessage() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('修改成功！', {
        type: 'success',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        history.go(-1);
    }, 500);
}

function FailedMessage() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('修改失败！', {
        type: 'warning',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        history.go(-1);
    }, 500);
}

function SuccessSettingMessage() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('修改成功！', {
        type: 'success',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        window.location.href = getUrlWithoutParm(window.location.href);
    }, 500);
}

function FailedSettingMessage() {
    // 创建 Messger 实例
    var myMessager;
    myMessager = new $.zui.Messager('修改失败！', {
        type: 'warning',
        icon: 'bell', // 定义消息图标
        time: 0 // 不进行自动隐藏
    });

    // 先显示消息
    myMessager.show();

    // 5 秒之后隐藏消息
    setTimeout(function () {
        myMessager.hide();
        window.location.href = getUrlWithoutParm(window.location.href);
    }, 500);
}

//获取url
function getUrlWithoutParm(url) {
    //var url = document.location.toString();
    var arrUrl = url.split("?");
    var para = arrUrl[0];
    return para;
}

// 删除url中某个参数,并跳转
function funcUrlDel(name) {
    var loca = window.location;
    var baseUrl = loca.origin + loca.pathname + "?";
    var query = loca.search.substr(1);
    if (query.indexOf(name) > -1) {
        var obj = {}
        var arr = query.split("&");
        for (var i = 0; i < arr.length; i++) {
            arr[i] = arr[i].split("=");
            obj[arr[i][0]] = arr[i][1];
        }
        delete obj[name];
        var url = baseUrl + JSON.stringify(obj).replace(/[\"\{\}]/g, "").replace(/\:/g, "=").replace(/\,/g, "&");
        return url
    }
}