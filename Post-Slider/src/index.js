// src/index.js
import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit'
import Save from './save'

registerBlockType('my-plugin/post-slider', {
    title: 'Post Slider',
    icon: (
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="4" fill="#4A90E2"/>
            <path d="M5 12L9 8V16L5 12Z" fill="white"/>
            <path d="M15 8L19 12L15 16V8Z" fill="white"/>
        </svg>
    ),
    category: 'made-by-pranit-dugad',
    attributes: {
        url: { type: 'string', default: 'https://wptavern.com/wp-json/wp/v2/posts' },
        autoScroll: { type: 'boolean', default: true },
        loop: { type: 'boolean', default: true },
        showDots: { type: 'boolean', default: true },
        showDate: { type: 'boolean', default: true },
    },
    edit: Edit,
    save: Save, // Server-side rendering
});