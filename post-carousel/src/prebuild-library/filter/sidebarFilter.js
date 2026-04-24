import { RadioControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

const FilterSidebar = ( props ) => {
    const {
        changeStates,
		fieldValue,
		fieldOptions,
        allData,
        tabName,
    } = props;

    const filterCount = allData?.reduce( (acc, item) => {
        if ( tabName === "ready-pages" ) {
            item.pages?.forEach((page) => {
                const type = page.type;
                if (type) {
                    acc[type] = (acc[type] || 0) + 1;
                }
            });
        } else {
            const category = item.category;
            acc[category] = (acc[category] || 0) + 1;
        }
        return acc;
    }, {});

    const blockTypeObject = {
        "ready-patterns": __("Block Types", "post-carousel"),
        "starter-sites": __("Category Types", "post-carousel"),
        "ready-pages": __("Pages Types", "post-carousel"),
    }

    return (
        <div className="sp-smart-template-filter-category">
            <h3 className="sp-smart-template-library-sidebar-header">
               Pattern Types
            </h3>
            <div className="sp-smart-post-patter-type">
                <RadioControl
                    onChange={(v) => {
                        changeStates("freePro", v);
                    }}
                    options={[
                        {
                            label: "All",
                            value: "all"
                        },
                        {
                            label: "Free",
                            value: "free"
                        },
                        {
                            label: "Pro",
                            value: "pro"
                        }
                    ]}
                    selected={fieldValue?.freePro}
                />
            </div>
            <h3 className="sp-smart-template-library-sidebar-header">
               { blockTypeObject[tabName] }
            </h3>
            { fieldOptions?.filterArr?.length > 0 && (
                <>
                <div className="sp-smart-sidebar-category-filter">
                    { fieldOptions?.filterArr?.map( (option, index) => {
                        const allOptionCount = tabName === "ready-pages" ? fieldOptions?.filterArr?.length : allData?.length;
                        const optionCount = filterCount[ option?.value ]

                        return (
                            <label
                                key={ index }
                                htmlFor={`filter-option-${index}`}
                                className={`sp-smart-sidebar-option ${option?.value === fieldValue?.filter ? "sp-active" : ""}`}
                            >
                                <input
                                    type="radio"
                                    id={`filter-option-${index}`}
                                    name="sp-smart-category-option"
                                    className="sp-smart-category-filter"
                                    value={option?.value}
                                    checked={ option?.value === fieldValue?.filter }
                                    onChange={() => changeStates("filter", option?.value)}
                                />
                                <span className="sp-smart-radio-label">
                                    {option?.label}
                                    { option?.value === "all" && ( <span>({allOptionCount})</span> ) }
                                    { (option?.value !== "all" && filterCount[ option?.value ]) && ( <span>({optionCount})</span> ) }
                                </span>
                            </label>
                        );
                    })}
                </div>
                </>
            ) }
        </div> 
    );
}
export default FilterSidebar;