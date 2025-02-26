// src/index.js
import { registerBlockType } from '@wordpress/blocks';
import { TextControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { useEffect, useState } from '@wordpress/element';

registerBlockType('my-plugin/post-slider', {
    title: 'Post Slider',
    icon: 'slides',
    category: 'widgets',
    attributes: {
        url: {
            type: 'string',
            default: 'https://wptavern.com/wp-json/wp/v2/posts',
        },
    },
    edit: ({ attributes, setAttributes }) => {
        const { url } = attributes;
        return (
            <div>
                <TextControl
                    label="Posts URL"
                    value={url}
                    onChange={(newUrl) => setAttributes({ url: newUrl })}
                />
                <ServerSideRender
                    block="my-plugin/post-slider"
                    attributes={{ url }}
                />
            </div>
        );
    },
    save: () => {
        return null; // Use server-side rendering.
    },
});