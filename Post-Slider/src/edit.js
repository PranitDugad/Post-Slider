import { PanelBody, ToggleControl, TextControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit({ attributes, setAttributes }) {
    const { url, autoScroll, loop, showDots, showDate } = attributes;
    return (
        <div>
            <InspectorControls> 
                <PanelBody title="Slider Settings" initialOpen={true}>
                    <TextControl
                        label="Posts URL"
                        value={url}
                        onChange={(newUrl) => setAttributes({ url: newUrl })}
                    />
                    <ToggleControl
                        label="Auto Scroll"
                        checked={autoScroll}
                        onChange={() => setAttributes({ autoScroll: !autoScroll })}
                    />
                    <ToggleControl
                        label="Loop"
                        checked={loop}
                        onChange={() => setAttributes({ loop: !loop })}
                    />
                    <ToggleControl
                        label="Show Dots"
                        checked={showDots}
                        onChange={() => setAttributes({ showDots: !showDots })}
                    />
                    <ToggleControl
                        label="Show Post Date"
                        checked={showDate}
                        onChange={() => setAttributes({ showDate: !showDate })}
                    />
                </PanelBody>
            </InspectorControls>
            <ServerSideRender block="my-plugin/post-slider" attributes={attributes} />
        </div>
    );
}
