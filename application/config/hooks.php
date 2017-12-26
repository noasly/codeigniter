<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

/*
| -------------------------------------------------------------------------
| 참고 url : http://rustyvirus.tistory.com/entry/Codeigniter-Hook%EC%9C%BC%EB%A1%9C-%ED%97%A4%EB%8D%94
|            -%ED%91%B8%ED%84%B0-%EB%A7%B9%EA%B8%80%EC%96%B4%EB%B3%B4%EC%9E%90
| -------------------------------------------------------------------------
| * pre_system(시스템 작동초기)
|
|   벤치마크와 후킹클래스들만 로드된 상태로서, 라우팅을 비롯한 어떤 다른 프로세스도 진행되지않은 상태
|
| * pre_controller(컨트롤러가 호출되기 직전)
|
|   모든 기반클래스(base classes), 라우팅 그리고 보안점검이 완료된 상태
|
| * post_controller_constructor(컨트롤러가 인스턴스화 된 직후)
|
|    사용준비가 완료된 상태지만, 인스턴스화 된후 메소드들이 호출되기 직전
|
| * post_controller(컨트롤러가 완전히 수행된 직후)
|
| * display_override(_display() 함수를 재정의)
|
|   최종적으로 브라우저에 페이지를 전송할때 사용됨
|
| * cache_override
|
|   출력클래스(output class) 에 있는_display_cache() 함수 대신 요놈을 사용
|
| * post_system
|
|   최종 렌더링 페이지가 브라우저로 보내진후에 호출
|
*/

$hook['post_controller_constructor'][] = [
	'class'    => 'SiteBuilder',
	'function' => 'loadHeader',
	'filename' => 'SiteBuilder.php',
	'filepath' => 'hooks',
	'params' => ''
];

$hook['post_system'][] = [
	'class'    => 'SiteBuilder',
	'function' => 'loadFooter',
	'filename' => 'SiteBuilder.php',
	'filepath' => 'hooks',
	'params' => ''
];

$hook['post_controller_constructor'][] = [
    'class'     => 'SiteBuilder',
    'function'  => 'checkPermission',
    'filename'  => 'SiteBuilder.php',
    'filepath'  => 'hooks'
];