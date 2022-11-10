import jquery from 'jquery';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

let $ = jquery;

export default function site() {

    // Private Variables
    let $window     = $(window),
        $doc        = $(document),
		$body = $('body');
	
	const menu_trigger = document.getElementById('menu-trigger');
	gsap.registerPlugin(ScrollTrigger);

	let scrolled_height = '148px';
	let scrolled_pos = 'translate(-74px, 0px)';
	let scrolled_top = '10px';
	let intro = document.getElementById('intro');
	let project_sidebar = document.querySelector('.single-project-sidebar-container');

	ScrollTrigger.matchMedia({
		"(max-width: 768px)": function () {
			scrolled_height = '100px';
			scrolled_pos = 'translate(-50px, 0px)';
			scrolled_top = '5px';
		}
	});

	if ( intro ) {
		gsap.to('#maxinacube-logo', {
			top: scrolled_top,
			height: scrolled_height,
			transform: scrolled_pos,
			scrollTrigger: {
				trigger: intro,
				start: 'top 90%',
				end: 'top 50%',
				scrub: true
			}
		});
		
		gsap.to('header', {
			backgroundColor: 'rgba(240, 240, 240, 0.85)',
			backdropFilter: 'blur(4px)',
			borderColor: '#000000',
			scrollTrigger: {
				trigger: intro,
				start: 'top 50%',
				end: 'top 40%',
				scrub: true
			}
		});
	}

	menu_trigger.addEventListener('click', (e) => {
		document.body.classList.toggle('menu-active');
	});
}
