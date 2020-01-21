<template>
	<div class="">
		<editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
			<div class="flex items-center border-t border-l border-r rounded-t">
				<button class="p-1 rounded hover:bg-gray-200" :class="{ 'is-active': isActive.bold() }" @click.prevent="commands.bold">
					<bold-icon class="w-4 h-4"></bold-icon>
				</button>
				<button class="p-1 rounded hover:bg-gray-200" :class="{ 'is-active': isActive.bold() }" @click.prevent="commands.bold">
					<italic-icon class="w-4 h-4"></italic-icon>
				</button>
				<button class="p-1 leading-none font-thin rounded hover:bg-gray-200" :class="{ 'is-active': isActive.heading({ level: 2 }) }" @click.prevent="commands.heading({ level: 2 })">
					H2
				</button>
				<button class="p-1 leading-none font-thin rounded hover:bg-gray-200" :class="{ 'is-active': isActive.heading({ level: 3 }) }" @click.prevent="commands.heading({ level: 2 })">
					H3
				</button>
			</div>
		</editor-menu-bar>
		<editor-content class="bg-gray-200 text-gray-700 border border-gray-200 rounded-b leading-tight" :editor="editor" />
	</div>
</template>

<script>
	import debounce from 'just-debounce-it';
	import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
	import { BoldIcon, ItalicIcon, UnderlineIcon, MinusIcon, CornerUpLeftIcon, CornerUpRightIcon } from 'vue-feather-icons'
	import {
		BulletList,
		HardBreak,
		Heading,
		ListItem,
		OrderedList,
		TodoItem,
		TodoList,
		Bold,
		Italic,
		Strike,
		Underline,
		History,
	} from 'tiptap-extensions'

	export default {

		name: 'BasicEditor',

		props:['value', 'debounce'],

		data () {
			return {
				editor: null,
			}
		},
		watch: {
			value: function(value){
				this.editor.setContent(value);
			}
		},
		components: {
			EditorContent,
			EditorMenuBar,
			BoldIcon,
			ItalicIcon,
			UnderlineIcon,
			MinusIcon,
			CornerUpLeftIcon,
			CornerUpRightIcon,
		},
		mounted() {
			this.editor = new Editor({
				extensions: [
					new BulletList(),
					new HardBreak(),
					new Heading({ levels: [1, 2, 3] }),
					new ListItem(),
					new OrderedList(),
					new TodoItem(),
					new TodoList(),
					new Bold(),
					new Italic(),
					new Strike(),
					new Underline(),
					new History(),
				],
				content: this.value,
				onUpdate: ({ getHTML }) => {
					this.html=getHTML();
					if (this.html === '<p></p>'){
						this.content = '';
					} else {
						this.content = this.html;
					}
					this.debounceValue.call(this, this.html);
				}
			});
		},
		beforeDestroy() {
			this.editor.destroy()
		},
		created: function(){
			this.debounceValue = debounce((newValue) => this.$emit('input', newValue), 500);
		}
	}
</script>

<style lang="css" scoped>

</style>